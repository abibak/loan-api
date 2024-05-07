<?php

namespace App\Http\Controllers\API;

use App\Exceptions\APIException;
use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function jwtPayload(User $user): string
    {
        $payload = [
            'iss' => env('APP_NAME'),
            'sub' => $user,
            'iat' => time(),
            'exp' => time() + 60 * 60,
        ];

        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request['email'])->first();

        if ($user) {
            if (Hash::check($request['password'], $user->password)) {
                return response()->json([
                    'data' => [
                        'token' => $this->jwtPayload($user),
                        'message' => 'Successfully login'
                    ],
                ]);
            }

            throw new APIException('Verification error', 400);
        }

        throw new APIException('User not found.', 404);
    }
}
