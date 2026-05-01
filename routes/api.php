<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;

// Ryan: REST API route definitions for auth, product endpoints, and protected review actions.
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('api.token')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/reviews', [ReviewController::class, 'store']);
});
// This code defines API routes for authentication (login/register),
//a protected product listing and detail view, and a protected review submission endpoint — 
//all requiring a valid api.token middleware except the public auth endpoints.
