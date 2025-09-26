<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Customer;
use App\Models\MeterRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $totalTagihan = MeterRecord::whereYear('created_at', $tahunIni)
            ->whereMonth('created_at', $bulanIni)
            ->count();

        $sudahBayar = MeterRecord::whereYear('created_at', $tahunIni)
            ->whereMonth('created_at', $bulanIni)
            ->where('status', 'sudah_bayar')
            ->count();

        $belumBayar = $totalTagihan - $sudahBayar;

        $persenBayar = $totalTagihan > 0 ? round(($sudahBayar / $totalTagihan) * 100, 2) : 0;
        $persenBelum = 100 - $persenBayar;

        $trendPendapatan = MeterRecord::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(total_amount) as total')
        )
        ->whereYear('created_at', $tahunIni)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

        return view('dashboard', compact(
            'totalCustomers',
            'sudahBayar',
            'belumBayar',
            'persenBayar',
            'persenBelum',
            'trendPendapatan'
        ));
    }
}
