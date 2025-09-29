<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencatatanStoreRequest;
use App\Http\Requests\PencatatanUpdateRequest;
use App\Models\MeterRecord;
use Illuminate\Support\Facades\Storage;
use App\Models\SetPrice;
use App\Services\PencatatanService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PencatatanController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new PencatatanService;
    }

    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $nama   = $request->query('name');

        $query = MeterRecord::with('customer')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        if ($nama) {
            $query->whereHas('customer', function ($q) use ($nama) {
                $q->where('name', 'like', '%' . $nama . '%');
            });
        }

        $records = $query->get()->map(function ($record) {
            $record->created_at_formatted = Carbon::parse($record->created_at)
                ->locale('id')
                ->translatedFormat('d F Y');
            return $record;
        });

        return successResponse('History', $records);
    }

    public function store(PencatatanStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $tglInput = Carbon::now();
        $exists = MeterRecord::where('customer_id', $data['customer_id'])
            ->whereMonth('created_at', $tglInput->month)
            ->whereYear('created_at', $tglInput->year)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'customer_id' => ['Pencatatan meter untuk pelanggan tsb di bulan ini sudah ada. Silakan refresh halaman untuk mendapat data terbaru.'],
            ]);
        }


        $storedEvidencePath = null;
        $storedReceiptPath  = null;

        try {
            if ($request->hasFile('evidence')) {
                $storedEvidencePath = $request->file('evidence')->store('evidence', 'public');
                if (! $storedEvidencePath) {
                    throw new \RuntimeException('Gagal menyimpan file bukti.');
                }
                $data['evidence'] = $storedEvidencePath;
            }

            $data['receipt'] = '';
            $result = DB::transaction(function () use ($data, $tglInput, &$storedReceiptPath) {
                $periode = $tglInput->copy()->startOfMonth();

                $set = SetPrice::selectRaw('COALESCE(price,0) AS price, COALESCE(admin_fee,0) AS admin_fee')->first();

                if ($set === null) {
                    throw new \RuntimeException('Data harga layanan belum ada, silakan hubungi admin.', 422);
                }
                $price     = (float) ($set->price ?? 0);
                $admin_fee = (float) ($set->admin_fee ?? 0);

                $meter_lalu = $data['meter_lalu'];
                unset($data['meter_lalu']);
                $data['usage'] = $data['meter'] - $meter_lalu;
                $materai     = $data['duty_stamp'] ?? 0;
                $retribusi   = $data['retribution_fee'] ?? 0;
                $denda       = $data['fine'] ?? 0;
                $admin_loket = auth()->user()->name ?? '-';
                $harga_air = $price * $data['usage'];
                if ($harga_air === 0) {
                    $admin_fee = 0;
                    $materai = 0;
                    $retribusi = 0;
                    $denda = 0;
                }
                $data['total_amount'] = $harga_air + $admin_fee + $materai + $retribusi + $denda;
                $pencatatan = MeterRecord::create($data);

                $mm_to_pt = 72 / 25.4;
                $width_pt  = 58 * $mm_to_pt;
                $height_pt = 130 * $mm_to_pt;

                $pdf = Pdf::loadView('exports.pdf.struk-pembayaran', [
                    'customer'    => $pencatatan->customer,
                    'periode'     => $periode,
                    'meter_lalu'  => $meter_lalu,
                    'meter_ini'   => $pencatatan->meter,
                    'pakai'       => $pencatatan->usage,
                    'harga_air'   => $harga_air,
                    'admin_fee'   => $admin_fee,
                    'materai'     => $pencatatan->duty_stamp,
                    'retribusi'   => $pencatatan->retribution_fee,
                    'denda'       => $pencatatan->fine,
                    'admin_loket' => $admin_loket,
                    'total'       => $pencatatan->total_amount,
                ])->setPaper([0, 0, $width_pt, $height_pt], 'portrait');

                $filename = 'struk-' . $pencatatan->id . '.pdf';
                $path     = 'struk/' . $filename;

                $putOk = Storage::disk('public')->put($path, $pdf->output());
                if (! $putOk) {
                    throw new \RuntimeException('Gagal menyimpan file struk.');
                }
                $storedReceiptPath = $path;
                $pencatatan->update(['receipt' => $path]);
                return $pencatatan->fresh(['customer']);
            });

            return successResponse("Data berhasil disimpan!", $result, 201);
        } catch (\Throwable $e) {
            if ($storedReceiptPath && Storage::disk('public')->exists($storedReceiptPath)) {
                Storage::disk('public')->delete($storedReceiptPath);
            }
            if ($storedEvidencePath && Storage::disk('public')->exists($storedEvidencePath)) {
                Storage::disk('public')->delete($storedEvidencePath);
            }
            throw $e;
        }
    }

    public function update(PencatatanUpdateRequest $request, string $id)
    {
        $ok = $this->service->update($id, $request->validated());

        if (!$ok) {
            return errorResponse('Data tidak ditemukan atau gagal diperbarui.', 422);
        }

        $data = MeterRecord::find($id);
        return successResponse('Pencatatan berhasil diperbarui.', $data, 200);
    }

    public function getPieChart(Request $request)
    {
        $bulan = (int) $request->query('bulan', now()->month);
        $tahun = now()->year;

        $userId  = $request->user()->id;
        $current = Carbon::createFromDate($tahun, $bulan, 1);
        $previous = $current->copy()->subMonth();

        $bulanIni = MeterRecord::query()
            ->where('user_id', $userId)
            ->whereMonth('created_at', $current->month)
            ->whereYear('created_at', $current->year)
            ->count();

        $bulanSebelumnya = MeterRecord::query()
            ->where('user_id', $userId)
            ->whereMonth('created_at', $previous->month)
            ->whereYear('created_at', $previous->year)
            ->count();

        if ($bulanSebelumnya > 0) {
            $persentase = (($bulanIni - $bulanSebelumnya) / $bulanSebelumnya) * 100;
        } else {
            if ($bulanIni > 0) {
                $persentase = $bulanIni * 100;
            } else {
                $persentase = 0;
            }
        }
        return successResponse("Data pencatatan per bulan", [
            'bulan'               => $current->month,
            'total'               => $bulanIni,
            'persentase' => round($persentase, 2),
        ]);
    }

    public function getBarChart(Request $request)
    {
        $tahun  = (int) $request->query('tahun', now()->year);
        $userId = $request->user()->id;

        $records = MeterRecord::query()
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('user_id', $userId)
            ->whereYear('created_at', $tahun)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'bulan');
        $data = [];
        foreach (range(1, 12) as $bulan) {
            $data[] = [
                'bulan' => Carbon::createFromDate(null, $bulan, 1)->translatedFormat('F'),
                'total' => $records[$bulan] ?? 0,
            ];
        }

        return successResponse("Data pencatatan per bulan pada tahun $tahun", [
            'tahun' => $tahun,
            'data'  => $data,
        ]);
    }
}
