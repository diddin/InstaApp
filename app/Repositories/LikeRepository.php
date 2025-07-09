<?php

namespace App\Repositories;

use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggle(Post $post, int $userId): bool
    {
        $like = $post->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return false; // unliked
        } else {
            $post->likes()->create(['user_id' => $userId]);
            return true; // liked
        }
    }
}
