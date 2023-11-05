<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenggunaLoginRequest;
use App\Http\Resources\PenggunaLoginResource;
use App\Models\Pengguna;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(PenggunaLoginRequest $request)
    {
        $pengguna = Pengguna::where('email', $request['email'])->first();

        if (!$pengguna || !Hash::check($request->password, $pengguna->password)) {
            throw new HttpResponseException(response([
                "errors" => [
                    "message" => [
                        "Email atau password salah"
                    ]
                ]
            ], 422));
        }

        $token = $pengguna->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Success',
            'token' => $token,
            'user' => new PenggunaLoginResource($pengguna)
        ], 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Success'
        ], 201);
    }
}
