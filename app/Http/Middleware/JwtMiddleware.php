<?php

namespace App\Http\Middleware;

use App\Exceptions\APIException;
use App\Models\User;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authorization');

        if ($token) {
            try {
                $decoded = json_encode(JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256')));
                $decoded_array = json_decode($decoded, true);
            } catch (Exception $e) {
                throw new APIException($e->getMessage(), 400);
            }

            $user = User::find($decoded_array['sub']);

            if ($user) {
                return $next($request);
            }
        }

        throw new APIException('Invalid request', 404);
    }
}
