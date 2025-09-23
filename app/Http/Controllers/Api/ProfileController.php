<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->user()->id);

        if (! $user) {
            return errorResponse("Data user tidak ditemukan!", 404);
        }

        return successResponse("Data user", $user);
    }
}
