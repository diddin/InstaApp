<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    protected $commentService;

    use AuthorizesRequests, ApiResponse;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment = $this->commentService->addComment($post, $validated);

        return $this->createdResponse(
            new CommentResource($comment),
            'Komentar berhasil ditambahkan.'
        );
    }

    public function index(Post $post): JsonResponse
    {
        $comments = $this->commentService->paginateByPost($post);
        if ($comments->isEmpty()) {
            return $this->successResponse([], 'Tidak ada komentar untuk postingan ini.');
        }

        return $this->successPaginatedResponse(
            CommentResource::collection($comments),
            'Komentar berhasil diambil.'
        );
    }

    public function destroy(Post $post, $commentId): JsonResponse
    {
        $comment = $this->commentService->findByPostAndId($post, $commentId);

        $this->authorize('delete', $comment);

        $comment->delete();

        return $this->successResponse(null, 'Komentar berhasil dihapus.');
    }
}
