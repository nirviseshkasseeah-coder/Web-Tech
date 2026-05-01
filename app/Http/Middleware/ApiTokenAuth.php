<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenAuth
{
    // Ryan: bearer-token middleware for protecting authenticated API routes.
    public function handle(Request $request, Closure $next): Response
    {
        $plainToken = $request->bearerToken();

        if (!$plainToken) {
            return new JsonResponse([
                'message' => 'Missing Bearer token.',
            ], 401);
        }

        $hashedToken = hash('sha256', $plainToken);

        $token = ApiToken::with('user')
            ->where('Token', $hashedToken)
            ->first();

        if (!$token || !$token->user) {
            return new JsonResponse([
                'message' => 'Invalid token.',
            ], 401);
        }

        if ($token->ExpiresAt && $token->ExpiresAt->isPast()) {
            return new JsonResponse([
                'message' => 'Token has expired.',
            ], 401);
        }

        $request->setUserResolver(fn () => $token->user);

        return $next($request);
    }
}
