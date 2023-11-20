<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAddFormRequest;
use App\Http\Requests\PostDeleteFormRequest;
use App\Http\Requests\PostUpdateFormRequest;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list(PostRepository $postRepository)
    {
        $posts = $postRepository->getAllByUser();
        return response()->json([
            'posts' => $posts
        ]);
    }

    public function last(PostRepository $postRepository)
    {
        $posts = $postRepository->getLastByUser();
        return response()->json([
            'posts' => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostAddFormRequest $request, PostRepository $postRepository)
    {
        $saved = $postRepository->store($request);
        if ($saved) {
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
     * Update the specified resource in storage.
     */
    public function update(PostUpdateFormRequest $request, PostRepository $postRepository)
    {
        $updated = $postRepository->update($request);
        if ($updated) {
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
    public function delete(PostDeleteFormRequest $request, PostRepository $postRepository)
    {
        $deleted = $postRepository->delete($request->id);
        if ($deleted) {
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }
}
