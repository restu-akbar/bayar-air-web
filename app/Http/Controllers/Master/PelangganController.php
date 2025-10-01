<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Services\PelangganService;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new PelangganService;
    }

    public function index(Request $request)
    {
        return $this->service->index($request);
    }

    public function create()
    {
        return view('master.pelanggan.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:13|unique:customers,phone_number',
            'rt' => 'required',
            'rw' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        Customer::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        // Redirect with success message
        return redirect()->route('master.pelanggan.index')->with('success', 'Customer created successfully.');
    }

    public function show(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $recap = $this->service->getMeterPerBulan($id, $request->get('tahun', date('Y')));

        return view('master.pelanggan.show', compact('customer', 'recap'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('master.pelanggan.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255,' . $customer->id,
            'address' => 'required|string|max:255,' . $customer->id,
            'phone_number' => 'required|string|max:13|unique:customers,phone_number,' . $customer->id,
            'rt' => 'required',
            'rw' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'rt' => $request->rt,
            'rw' => $request->rw,
        ]);

        return redirect()->route('master.pelanggan.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('master.pelanggan.index')->with('success', 'Customer deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new CustomerImport, $request->file('file'));

        return redirect()->route('master.pelanggan.index')->with('success', 'Data berhasil diimport!');
    }
}
