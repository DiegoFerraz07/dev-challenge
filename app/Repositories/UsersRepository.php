<?php

namespace App\Repositories;

use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Interfaces\UsersRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Log;

class UsersRepository implements UsersRepositoryInterface
{

    public function getAll(): Collection
    {
        return Users::all()
            ->sortByDesc('id');
    }

    /**
     * find a supply by name or CNPJ and return first 10
     *
     * @param string $search
     *
     * @return Collection<Users>
     */
    public function find(string $search): Collection
    {
        return Users::where(function($q) use ($search) {
            $q->where("name", "LIKE", "%$search%")
                ->orWhere("email", $search);
        })->limit(10)->get();
    }

    /**
     * Delete a specific users
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $deleted = Users::where('id', $id)
            ->delete();

        return $deleted
            ? true
            : false;
    }

    /**
     * Store a new supply
     * @param UsersAddFormRequest $request
     *
     * @return bool
     */
    public function store(UsersAddFormRequest $request): bool
    {
        try {
            $users = new Users();
            $users->fillUsers($request);
            return $users->save();
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }


    /**
     * get a specific users
     * @param int $id
     *
     * @return Users|null
     */
    public function get(int $id): Users|null
    {
        return Users::where('id', $id)->first();
    }


    /**
     * Store a new user
     * @param UsersAddFormRequest $request
     *
     * @return bool
     */
    public function update(UsersUpdateFormRequest $request): bool
    {
        try {
            $users = $this->get($request->id);
            $users->fillUsers($request);
            return $users->update();
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }

}
