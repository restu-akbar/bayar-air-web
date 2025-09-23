<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\MeterRecord;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

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
                    $editUrl = route('pelanggan.edit', $row->id);
                    $deleteUrl = route('pelanggan.destroy', $row->id);
                    return '
                        <a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>
                        <form action="' . $deleteUrl . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this user?\');">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>';
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
                ->addSelect([
                    'meter_lalu' => MeterRecord::query()
                        ->select('meter')
                        ->whereColumn('meter_records.customer_id', 'customers.id')
                        ->whereBetween('created_at', [$start, $end])
                        ->latest('created_at')
                        ->limit(1)
                ])->whereNotExists(function ($q) use ($thisStart, $thisEnd) {
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
}
