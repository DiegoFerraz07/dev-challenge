<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersFormRequest;
use App\Http\Requests\UsersAddFormRequest;
use App\Http\Requests\UsersDeleteFormRequest;
use App\Http\Requests\UsersEditFormRequest;
use App\Http\Requests\UsersFollowFormRequest;
use App\Http\Requests\UsersUpdateFormRequest;
use App\Models\User;
use App\Http\Resources\UsersResource;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(UsersUpdateFormRequest $request, UsersRepository $usersRepository)
    {
        $updated = $usersRepository->update($request);
        if($updated) {
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Erro ao tentar salvar'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(UsersDeleteFormRequest $request, UsersRepository $usersRepository)
    {
        $deleted = $usersRepository->delete($request->id);
        if($deleted) {
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }

    public function follow(UsersFollowFormRequest $request, UsersRepository $usersRepository)
    {
        $follow = $usersRepository->follow($request);
        return response()->json([
            'follow' => $follow
        ]);;
    }
}
