<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginFormRequest;
use App\Http\Requests\UsersAddFormRequest;
use App\Http\Resources\UserAuthResources;
use App\Http\Resources\UserLoginResources;
use App\Models\User;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UsersAddFormRequest $request, UsersRepository $userRepository)
    {
        $user = $userRepository->store($request);
        $token = $user->createToken('auth_token')->plainTextToken;

        return new UserAuthResources(
            [
                'saved' => [
                    'success' => true,
                    'message' => 'User created',
                    'token' => $token
                ]
            ]
        );
    }

    public function login(UserLoginFormRequest $request, UsersRepository $usersRepository)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = $usersRepository->getByEmail($request->email);

        $token = $user->createToken('auth_token')->plainTextToken;

        return new UserLoginResources([
            'token' => $token,
            'user' => $user
        ]);

    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
