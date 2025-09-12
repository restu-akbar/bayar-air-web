<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetPrice;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        // Ambil data setting pertama (jika ada)
        $setting = SetPrice::first();

        return view('master.setting.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric',
            'admin_fee' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $setting = SetPrice::firstOrNew(); // da data nya cuman satu.....
        $setting->fill($request->only(['price', 'admin_fee']))->save();


        return redirect()->route('setting.index')->with('success', 'Setting berhasil disimpan.');
    }
}
