<?php

namespace App\Repositories;

use App\Http\Requests\UsersAddFormRequest;
use App\Http\Requests\UsersFollowFormRequest;
use App\Http\Requests\UsersUpdateFormRequest;
use App\Interfaces\UsersRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\UserFollow;
use Exception;
use Illuminate\Support\Facades\Log;

class UsersRepository implements UsersRepositoryInterface
{

    public function getAll(): Collection
    {
        return User::all()
            ->sortByDesc('id');
    }

    public function getByEmail(string $email): User|null
    {
        return User::where('email', $email)->first();
    }

    /**
     *
     * @param string $search
     *
     * @return Collection<User>
     */
    public function find(string $search): Collection
    {
        return User::where(function($q) use ($search) {
            $q->where("name", "LIKE", "%$search%")
                ->orWhere("email", $search);
        })->limit(10)->get();
    }

    /**
     * Delete a specific user
     * @param int $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        $deleted = User::where('id', $id)
            ->delete();

        return $deleted
            ? true
            : false;
    }

    /**
     * Store a new user
     * @param UsersAddFormRequest $request
     *
     * @return User|null
     */
    public function store(UsersAddFormRequest $request): User|null
    {
        try {
            $user = new User();
            $user->fillUser($request);
            $user->save();
            return $user;
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }


    /**
     * get a specific users
     * @param int $id
     *
     * @return User|null
     */
    public function get(int $id): User|null
    {
        return User::where('id', $id)->first();
    }


    /**
     * Store a new user
     * @param UsersUpdateFormRequest $request
     *
     * @return bool
     */
    public function update(UsersUpdateFormRequest $request): bool
    {
        try {
            $users = $this->get($request->id);
            $users->fillUser($request);
            return $users->update();
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }

    public function follow(UsersFollowFormRequest $request) : bool
    {
        try {
            $follow = new UserFollow();
            $follow->fillFollow($request);
            $follow->save();
            return true;
        } catch(Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return false;
        }
    }
}
