<?php

namespace App\Http\Controllers\API\V1;

use App\Helpers\MessageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        $credentials = request(['mobile', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->failed(401,MessageHelper::Translate('unauthenticated'));
        }

        return response()->successful([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->successful();
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->successful([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
