<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\MeterRecord;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PelangganService
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::select(['id', 'name', 'address', 'phone_number', 'rt', 'rw', 'created_at']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                })
                ->addColumn('action', function ($row) {
                    $editUrl = route('master.pelanggan.edit', $row->id);
                    $deleteUrl = route('master.pelanggan.destroy', $row->id);
                    $showUrl = route('master.pelanggan.show', $row->id);
                    return '
                    <div class="d-flex">
                        <div>
                            <a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
                        </div>
                        <div>
                            <a href="' . $showUrl . '" class="btn btn-sm btn-info mx-2">Detail</a>
                        </div>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($request->expectsJson()) {
            $thisStart = now()->startOfMonth();
            $thisEnd   = now()->endOfMonth();
            $start = now()->subMonthNoOverflow()->startOfMonth();
            $end   = now()->subMonthNoOverflow()->endOfMonth();

            $customers = Customer::query()
                ->select('customers.*')
                ->selectRaw(
                    'COALESCE((
                SELECT mr.meter
                FROM meter_records mr
                WHERE mr.customer_id = customers.id
                  AND mr.created_at BETWEEN ? AND ?
                ORDER BY mr.created_at DESC
                LIMIT 1
            ), 0) AS meter_lalu',
                    [$start, $end]
                )
                ->whereNotExists(function ($q) use ($thisStart, $thisEnd) {
                    $q->selectRaw(1)
                        ->from('meter_records')
                        ->whereColumn('meter_records.customer_id', 'customers.id')
                        ->whereBetween('created_at', [$thisStart, $thisEnd]);
                })
                ->get();

            return $customers;
        }

        return view('master.pelanggan.index');
    }

    public function getMeterPerBulan($cid, $year) {
        $data = DB::select('
            SELECT
                t.meter_jan,
                t.meter_jan AS pakai_jan,

                t.meter_feb,
                CASE WHEN t.meter_feb IS NOT NULL
                    THEN (COALESCE(t.meter_feb,0) - COALESCE(t.meter_jan,0))
                    ELSE NULL END AS pakai_feb,

                t.meter_mar,
                CASE WHEN t.meter_mar IS NOT NULL
                    THEN (COALESCE(t.meter_mar,0) - COALESCE(t.meter_feb,0))
                    ELSE NULL END AS pakai_mar,

                t.meter_apr,
                CASE WHEN t.meter_apr IS NOT NULL
                    THEN (COALESCE(t.meter_apr,0) - COALESCE(t.meter_mar,0))
                    ELSE NULL END AS pakai_apr,

                t.meter_mei,
                CASE WHEN t.meter_mei IS NOT NULL
                    THEN (COALESCE(t.meter_mei,0) - COALESCE(t.meter_apr,0))
                    ELSE NULL END AS pakai_mei,

                t.meter_jun,
                CASE WHEN t.meter_jun IS NOT NULL
                    THEN (COALESCE(t.meter_jun,0) - COALESCE(t.meter_mei,0))
                    ELSE NULL END AS pakai_jun,

                t.meter_jul,
                CASE WHEN t.meter_jul IS NOT NULL
                    THEN (COALESCE(t.meter_jul,0) - COALESCE(t.meter_jun,0))
                    ELSE NULL END AS pakai_jul,

                t.meter_agu,
                CASE WHEN t.meter_agu IS NOT NULL
                    THEN (COALESCE(t.meter_agu,0) - COALESCE(t.meter_jul,0))
                    ELSE NULL END AS pakai_agu,

                t.meter_sep,
                CASE WHEN t.meter_sep IS NOT NULL
                    THEN (COALESCE(t.meter_sep,0) - COALESCE(t.meter_agu,0))
                    ELSE NULL END AS pakai_sep,

                t.meter_okt,
                CASE WHEN t.meter_okt IS NOT NULL
                    THEN (COALESCE(t.meter_okt,0) - COALESCE(t.meter_sep,0))
                    ELSE NULL END AS pakai_okt,

                t.meter_nov,
                CASE WHEN t.meter_nov IS NOT NULL
                    THEN (COALESCE(t.meter_nov,0) - COALESCE(t.meter_okt,0))
                    ELSE NULL END AS pakai_nov,

                t.meter_des,
                CASE WHEN t.meter_des IS NOT NULL
                    THEN (COALESCE(t.meter_des,0) - COALESCE(t.meter_nov,0))
                    ELSE NULL END AS pakai_des,

                t.bayar_jan, t.status_jan,
                t.bayar_feb, t.status_feb,
                t.bayar_mar, t.status_mar,
                t.bayar_apr, t.status_apr,
                t.bayar_mei, t.status_mei,
                t.bayar_jun, t.status_jun,
                t.bayar_jul, t.status_jul,
                t.bayar_agu, t.status_agu,
                t.bayar_sep, t.status_sep,
                t.bayar_okt, t.status_okt,
                t.bayar_nov, t.status_nov,
                t.bayar_des, t.status_des

            FROM (
                SELECT
                    MAX(CASE WHEN MONTH(created_at) = 1  THEN meter END) AS meter_jan,
                    MAX(CASE WHEN MONTH(created_at) = 1  THEN total_amount END) AS bayar_jan,
                    MAX(CASE WHEN MONTH(created_at) = 1  THEN status END) AS status_jan,

                    MAX(CASE WHEN MONTH(created_at) = 2  THEN meter END) AS meter_feb,
                    MAX(CASE WHEN MONTH(created_at) = 2  THEN total_amount END) AS bayar_feb,
                    MAX(CASE WHEN MONTH(created_at) = 2  THEN status END) AS status_feb,

                    MAX(CASE WHEN MONTH(created_at) = 3  THEN meter END) AS meter_mar,
                    MAX(CASE WHEN MONTH(created_at) = 3  THEN total_amount END) AS bayar_mar,
                    MAX(CASE WHEN MONTH(created_at) = 3  THEN status END) AS status_mar,

                    MAX(CASE WHEN MONTH(created_at) = 4  THEN meter END) AS meter_apr,
                    MAX(CASE WHEN MONTH(created_at) = 4  THEN total_amount END) AS bayar_apr,
                    MAX(CASE WHEN MONTH(created_at) = 4  THEN status END) AS status_apr,

                    MAX(CASE WHEN MONTH(created_at) = 5  THEN meter END) AS meter_mei,
                    MAX(CASE WHEN MONTH(created_at) = 5  THEN total_amount END) AS bayar_mei,
                    MAX(CASE WHEN MONTH(created_at) = 5  THEN status END) AS status_mei,

                    MAX(CASE WHEN MONTH(created_at) = 6  THEN meter END) AS meter_jun,
                    MAX(CASE WHEN MONTH(created_at) = 6  THEN total_amount END) AS bayar_jun,
                    MAX(CASE WHEN MONTH(created_at) = 6  THEN status END) AS status_jun,

                    MAX(CASE WHEN MONTH(created_at) = 7  THEN meter END) AS meter_jul,
                    MAX(CASE WHEN MONTH(created_at) = 7  THEN total_amount END) AS bayar_jul,
                    MAX(CASE WHEN MONTH(created_at) = 7  THEN status END) AS status_jul,

                    MAX(CASE WHEN MONTH(created_at) = 8  THEN meter END) AS meter_agu,
                    MAX(CASE WHEN MONTH(created_at) = 8  THEN total_amount END) AS bayar_agu,
                    MAX(CASE WHEN MONTH(created_at) = 8  THEN status END) AS status_agu,

                    MAX(CASE WHEN MONTH(created_at) = 9  THEN meter END) AS meter_sep,
                    MAX(CASE WHEN MONTH(created_at) = 9  THEN total_amount END) AS bayar_sep,
                    MAX(CASE WHEN MONTH(created_at) = 9  THEN status END) AS status_sep,

                    MAX(CASE WHEN MONTH(created_at) = 10 THEN meter END) AS meter_okt,
                    MAX(CASE WHEN MONTH(created_at) = 10 THEN total_amount END) AS bayar_okt,
                    MAX(CASE WHEN MONTH(created_at) = 10 THEN status END) AS status_okt,

                    MAX(CASE WHEN MONTH(created_at) = 11 THEN meter END) AS meter_nov,
                    MAX(CASE WHEN MONTH(created_at) = 11 THEN total_amount END) AS bayar_nov,
                    MAX(CASE WHEN MONTH(created_at) = 11 THEN status END) AS status_nov,

                    MAX(CASE WHEN MONTH(created_at) = 12 THEN meter END) AS meter_des,
                    MAX(CASE WHEN MONTH(created_at) = 12 THEN total_amount END) AS bayar_des,
                    MAX(CASE WHEN MONTH(created_at) = 12 THEN status END) AS status_des
                FROM meter_records
                WHERE customer_id = ?
                AND YEAR(created_at) = ?
            ) t

        ', [$cid, $year]);
        return count($data) > 0 ? $data[0] : null;
    }
}
