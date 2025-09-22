<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MeterRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $records = MeterRecord::with('customer')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($record) {
            $record->created_at_formatted = Carbon::parse($record->created_at)
                ->locale('nl')
                ->translatedFormat('d F Y'); // 22 augustus 2025
            return $record;
        });
            
        if ($records){
            return successResponse("History", $records, 201);
        }
        return errorResponse("Tidak Ada History", 404);
    }
}
