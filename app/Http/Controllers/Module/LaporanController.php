<?php

namespace App\Http\Controllers\module;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencatatanUpdateRequest;
use App\Models\MeterRecord;
use App\Services\PencatatanService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

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
                ->editColumn('sstatus', function ($row) {
                    return $row->status == 'sudah_bayar' ? '<span class="badge bg-success">Sudah Bayar</span>' :
                        '<span class="badge bg-danger">Belum Bayar</span>';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('laporan.detail', $row->id);
                    return '
                        <button type="button" class="btn btn-sm btn-primary btn-detail" data-url="' . $showUrl . '">
                            <i class="material-icons-outlined fs-6 align-middle">search</i> Detail
                        </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('module.laporan.index');
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

    public function update(PencatatanUpdateRequest $request, string $id)
    {
        $ok = $this->service->update($id, $request->validated());

        if (!$ok) {
            return back()->withErrors(['update' => 'Data tidak ditemukan atau gagal diperbarui.']);
        }

        return redirect()->route('module.laporan.laporan')->with('success', 'Data berhasil diperbarui.');
    }
}
