<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    use AuthorizesRequests, ApiResponse;

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAll();

        if ($posts->isEmpty()) {
            return $this->successResponse([], 'Tidak ada post yang ditemukan.');
        }

        return $this->successResponse(
            PostResource::collection($posts),
            'List post berhasil diambil'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post = $this->postService->store($validated);

        if (!$post) {
            return $this->errorResponse('Gagal membuat post', 500);
        }

        return $this->successResponse($post, 'Post berhasil diupload!', 201);
    }

    public function show(Post $post)
    {
        $post = $this->postService->getDetailWithRelations($post);

        if (!$post) {
            return $this->errorResponse('Post tidak ditemukan', 404);
        }

        return $this->successResponse(
            new PostResource($post),
            'Detail post berhasil diambil'
        );
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $this->postService->update($post, $validated);

        

        return $this->successResponse(
            new PostResource($post->fresh()),
            'Post berhasil diperbarui.'
        );
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->destroy($post);

        return $this->successResponse(null, 'Post berhasil dihapus.');
    }
}
