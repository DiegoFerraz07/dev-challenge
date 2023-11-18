<?php

use App\Http\Controllers\AuthController;
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

Route::prefix('users')->group(function () {
    // List users
    Route::get('/', [UsersController::class, 'index']);

    // List single users
    Route::get('/{id}', [UsersController::class, 'find']);

    // Create new users
    Route::post('/', [UsersController::class, 'store']);

    // Update users
    Route::put('/{id}', [UsersController::class, 'update']);

    // Delete users
    Route::delete('/{id}', [UsersController::class, 'delete']);
});
//rigistration
Route::post('/register', [AuthController::class, 'register']);

//login
Route::post('/login', [AuthController::class, 'login']);


//search user
Route::post('/me', [AuthController::class, 'me']);
