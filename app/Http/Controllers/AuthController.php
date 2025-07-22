<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = Auth::attempt($request->only('email', 'password'));

        if ($credentials == false) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        return response()->json([
            'token' => $user->createToken(config('app.name'))->plainTextToken,
        ], 200);
    }

    public function logout()
    {
        Auth::logout();

        $user = Auth::user();

        /** @var $token */
        $token = $user->currentAccessToken();
        $token->delete();

        return $this->apiResponse(message: trans('user::message.logout_message'));
    }
}
