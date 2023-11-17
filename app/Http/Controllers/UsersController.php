<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\UsersFormRequest;
use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersDeleteFormRequest;
use App\Http\Requests\Users\UsersEditFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Models\Users;
use App\Http\Resources\UsersResource;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::paginate(15);
        return UsersResource::collection($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsersAddFormRequest $request, UsersRepository $usersRepository)
    {
        $saved= $usersRepository->store($request);
        return new UsersRepository(['saved' => $saved]);
    }

    /**
     * Display the specified resource.
     */
    public function find(UsersFormRequest $request, UsersRepository $usersRepository)
    {
        $search = $request->search;
        $customers = $usersRepository->find($search);
        return compact('customers', 'search');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsersEditFormRequest $request,UsersRepository $usersRepository)
    {
        $users = $usersRepository->get($request->id);
        return $users;
    }

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
}
