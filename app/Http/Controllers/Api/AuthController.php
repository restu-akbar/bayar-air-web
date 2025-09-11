<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:8'
        ], [
            'password.min' => 'Password minimal 8 karakter'
        ]);
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($field, $request->login)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            $field = $field === 'email' ? 'Email' : 'Username';
            return errorResponse($field . ' atau password yang anda masukkan salah', 404);
        }
        $user->tokens()->delete();
        $token = $user->createToken('mobile-token')->plainTextToken;

        return successResponse("Login berhasil", [
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return successResponse('Log out berhasil', statusCode: 200);
    }
}
