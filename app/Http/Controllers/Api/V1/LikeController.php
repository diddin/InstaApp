<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle(Post $post): JsonResponse
    {
        $liked = $this->likeService->toggle($post);

        return response()->json([
            'message' => $liked ? 'Post liked' : 'Post unliked',
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ]);
    }
}
