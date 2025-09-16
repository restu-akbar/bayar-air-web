<?php

namespace App\Services;

use App\Models\Customer;
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
            return Customer::all();
        }

        return view('master.pelanggan.index');
    }
}
