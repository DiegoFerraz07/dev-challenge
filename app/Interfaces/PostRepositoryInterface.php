<?php

namespace App\Interfaces;

use App\Http\Requests\PostAddFormRequest;
use App\Http\Requests\PostUpdateFormRequest;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getAllByUser(): Collection;
    public function get(int $id): Post|null;
    public function delete(int $id): bool;
    public function store(PostAddFormRequest $request): Post|null;
    public function update(PostUpdateFormRequest $request): bool;
}
