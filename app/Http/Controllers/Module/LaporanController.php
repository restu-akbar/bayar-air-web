<?php

namespace App\Http\Controllers\module;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencatatanUpdateRequest;
use App\Models\MeterRecord;
use App\Services\PencatatanService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SetPrice;

class LaporanController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new PencatatanService;
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MeterRecord::with(['user', 'customer']);

            // filter rentang waktu
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate   = Carbon::parse($request->input('end_date'))->endOfDay();
                $data->whereBetween('meter_records.created_at', [$startDate, $endDate]);
            } elseif ($request->filled('start_date')) { //Start only
                $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
                $endDate   = Carbon::now()->endOfDay();
                $data->whereBetween('meter_records.created_at', [$startDate, $endDate]);
            } elseif ($request->filled('end_date')) { //End only
                $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
                $data->where('meter_records.created_at', '<=', $endDate);
            }

            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn() // untuk nomor urut
                ->editColumn('status', function ($row) {
                    return $row->status == 'sudah_bayar' ? '<span class="badge bg-success">Sudah Bayar</span>' :
                        '<span class="badge bg-danger">Belum Bayar</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('laporan.detail', $row->id);
                    $editUrl = route('laporan.edit', $row->id);
                    // $editUrl = route('laporan.detail', $row->id);
                    return '
                        <div class="d-flex gap-4">
                            <div>
                                <a href="' . $editUrl . '" class="btn btn-sm btn-warning">
                                    <i class="material-icons-outlined fs-6 align-middle">edit</i> Edit
                                </a>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary btn-detail" data-url="' . $showUrl . '">
                                <i class="material-icons-outlined fs-6 align-middle">search</i> Detail
                            </button>
                        </div>';
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

        return view('module.laporan.index');
    }
    
    public function edit($id)
    {
        $meterRecord = MeterRecord::with('customer')->findOrFail($id);
        $customer = $meterRecord->customer;

        // Cek record pertama pelanggan (berdasarkan tanggal paling awal)
        $firstMeterRecord = MeterRecord::where('customer_id', $customer->id)
            ->orderBy('created_at', 'asc')
            ->first();

        // Ambil record sebelumnya
        $previousMeterRecord = MeterRecord::where('customer_id', $customer->id)
            ->where('created_at', '<', $meterRecord->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $previousMeter = $previousMeterRecord ? $previousMeterRecord->meter : 0;
        $isFirstRecord = $firstMeterRecord && $firstMeterRecord->id === $meterRecord->id;

        $setPrice = SetPrice::latest()->first();

        return view('module.laporan.edit', compact(
            'meterRecord',
            'customer',
            'setPrice',
            'previousMeter',
            'isFirstRecord'
        ));
    }

    public function detail_popup($id)
    {
        $record = MeterRecord::with(['user', 'customer'])->findOrFail($id);

        return response()->json([
            'id' => $record->id,
            'customer' => $record->customer->name,
            'user' => $record->user->name,
            'meter' => $record->meter,
            'total_amount' => $record->total_amount,
            'fine' => $record->fine,
            'duty_stamp' => $record->duty_stamp,
            'retribution_fee' => $record->retribution_fee,
            'status' => $record->status,
            'created_at' => $record->created_at->format('d-m-Y'),
            'evidence' => asset('storage/' . $record->evidence),
            'receipt'  => $record->receipt ? asset('storage/' . $record->receipt) : null, // << tambahin ini
        ]);
    }

    public function update_laporan(Request $request, string $id)
    {
        $meterRecord = MeterRecord::findOrFail($id);
        $customer = $meterRecord->customer;

        // Ambil record sebelumnya
        $previousMeterRecord = MeterRecord::where('customer_id', $customer->id)
            ->where('created_at', '<', $meterRecord->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $previousMeter = $previousMeterRecord ? $previousMeterRecord->meter : 0;

        $setPrice = SetPrice::latest()->first();
        $price = $setPrice->price ?? 0;
        $adminFee = $setPrice->admin_fee ?? 0;

        // Hitung usage (pemakaian)
        $usage = max($request->meter - $previousMeter, 0);

        // Hitung total otomatis jika bukan catatan pertama
        $firstMeterRecord = MeterRecord::where('customer_id', $customer->id)
            ->orderBy('created_at', 'asc')
            ->first();

        $isFirstRecord = $firstMeterRecord && $firstMeterRecord->id === $meterRecord->id;
        $total = $isFirstRecord
            ? $request->total_amount // manual input jika catatan pertama
            : ($usage * $price) + $adminFee + ($request->fine ?? 0) + ($request->duty_stamp ?? 0) + ($request->retribution_fee ?? 0);

        // Update data
        $meterRecord->update([
            'meter' => $request->meter,
            'usage' => $usage,
            'fine' => $request->fine ?? 0,
            'duty_stamp' => $request->duty_stamp ?? 0,
            'retribution_fee' => $request->retribution_fee ?? 0,
            'total_amount' => $total,
            'status' => $request->status,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil diperbarui.');
    }

    public function update(PencatatanUpdateRequest $request, string $id)
    {
        $ok = $this->service->update($id, $request->validated());

        if (!$ok) {
            return back()->withErrors(['update' => 'Data tidak ditemukan atau gagal diperbarui.']);
        }

        return redirect()->route('module.laporan.laporan')->with('success', 'Data berhasil diperbarui.');
    }
}
