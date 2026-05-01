<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Ryan: API authentication endpoints for login, registration, and token issuance.
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('Email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->Password)) {
            return response()->json([
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $token = $this->issueToken($user);

        return response()->json([
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $this->formatUser($user),
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,Username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,Email'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'Username' => $validated['username'],
            'Email' => $validated['email'],
            'Password' => Hash::make($validated['password']),
        ]);

        $token = $this->issueToken($user);

        return response()->json([
            'message' => 'Registration successful.',
            'token' => $token,
            'user' => $this->formatUser($user),
        ], 201);
    }

    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $this->formatUser($request->user()),
        ]);
    }

    private function issueToken(User $user): string
    {
        $plainToken = Str::random(80);

        ApiToken::create([
            'UserID' => $user->UserID,
            'Token' => hash('sha256', $plainToken),
            'CreatedAt' => now(),
            'ExpiresAt' => now()->addDays(7),
        ]);

        return $plainToken;
    }

    private function formatUser(User $user): array
    {
        return [
            'UserID' => $user->UserID,
            'Username' => $user->Username,
            'Email' => $user->Email,
        ];
    }
}

// this AuthController handles API authentication: login() validates credentials and issues a 7-day token, 
// register() creates a new user with hashed password and returns a token, 
// user() returns the authenticated user's info, and private helpers 
// issueToken() stores SHA-256 hashed tokens in api_tokens table while returning the plain token, and 
// formatUser() standardizes user output.
