<?php

namespace App\Interfaces;

use App\Http\Requests\Users\UsersAddFormRequest;
use App\Http\Requests\Users\UsersUpdateFormRequest;
use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;

interface UsersRepositoryInterface
{
    public function getAll(): Collection;
    public function get(int $id): Users|null;
    public function find(string $search): Collection;
    public function delete(int $id): bool;
    public function store(UsersAddFormRequest $request): bool;
    public function update(UsersUpdateFormRequest $request): bool;
}
