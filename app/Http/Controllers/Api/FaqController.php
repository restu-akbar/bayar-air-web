<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::where('platform', 'mobile')->get();

        if (! $faq) {
            return errorResponse("Data faq tidak ditemukan!", 404);
        }

        return successResponse("Data faq", $faq);
    }
}
