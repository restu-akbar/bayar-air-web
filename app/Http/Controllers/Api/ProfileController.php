<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RuntimeException;

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

    public function update(ProfileUpdateRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($user->update($request->validated())) {
            return successResponse("Profil berhasil diperbarui", $user);
        }

        throw new RuntimeException("Terjadi kesalahan saat memperbarui data");
    }
}
