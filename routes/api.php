<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// List users
Route::get('users', [UsersController::class, 'index']);

// List single users
Route::get('users/{id}', [UsersController::class, 'find']);

// Create new users
Route::post('users', [UsersController::class, 'store']);

// Update users
Route::put('users/{id}', [UsersController::class, 'update']);

// Delete users
Route::delete('users/{id}', [UsersController::class,'delete']);
