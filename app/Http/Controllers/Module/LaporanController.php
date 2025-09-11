<?php

namespace App\Http\Controllers\module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        return view('module.laporan.index');
    }
}
    