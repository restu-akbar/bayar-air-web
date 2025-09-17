<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencatatanStoreRequest;
use App\Models\MeterRecord;
use App\Models\SetPrice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PencatatanController extends Controller
{

    public function store(PencatatanStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('evidence')) {
            $data['evidence'] = $request->file('evidence')->store('evidence', 'public');
        }

        $pencatatan = MeterRecord::create($data);
        if (! $pencatatan) {
            return errorResponse("Terjadi kesalahan saat menyimpan data");
        }

        $customer   = $pencatatan->customer;
        $periode    = now()->startOfMonth();

        $startPrev  = now()->subMonthNoOverflow()->startOfMonth();
        $endPrev    = now()->subMonthNoOverflow()->endOfMonth();
        $meter_lalu = MeterRecord::query()
            ->where('customer_id', $pencatatan->customer_id)
            ->whereBetween('created_at', [$startPrev, $endPrev])
            ->orderByDesc('created_at')
            ->value('meter') ?? 0;

        $meter_ini  = (int)($pencatatan->meter ?? 0);
        $pakai      = max(0, $meter_ini - (int)$meter_lalu);

        $set        = SetPrice::selectRaw('COALESCE(price,0) AS price, COALESCE(admin_fee,0) AS admin_fee')->first();
        $price      = (float) ($set->price ?? 0);
        $admin_fee  = (float) ($set->admin_fee ?? 0);

        $materai     = (float) $request->input('duty_stamp', 0);
        $retribusi   = (float) $request->input('retribution_fee', 0);
        $denda       = (float) $request->input('fine', 0);
        $admin_loket = Auth()->user()->name;

        $harga_air = $pakai * $price;
        $total = $harga_air + $admin_fee + $materai + $retribusi + $denda;
        $mm_to_pt = 72 / 25.4;
        $width_pt  = 58 * $mm_to_pt;
        $height_pt = 120 * $mm_to_pt;
        $pdf = Pdf::loadView('exports.pdf.struk-pembayaran', [
            'customer'    => $customer,
            'periode'     => $periode,
            'meter_lalu'  => $meter_lalu,
            'meter_ini'   => $meter_ini,
            'pakai'       => $pakai,
            'harga_air'   => $harga_air,
            'admin_fee'   => $admin_fee,
            'materai'     => $materai,
            'retribusi'   => $retribusi,
            'denda'       => $denda,
            'admin_loket' => $admin_loket,
            'total'       => $total,
        ])->setPaper([0, 0, $width_pt, $height_pt], 'portrait');

        $filename = 'struk-' . $pencatatan->id . '.pdf';
        $path     = 'struk/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());
        $url = asset('storage/' . $path);

        return successResponse("Data berhasil disimpan!", [
            'pencatatan' => $pencatatan,
            'struk' => [
                'url'      => $url,
                'filename' => $filename,
            ],
        ], 201);
    }
}
