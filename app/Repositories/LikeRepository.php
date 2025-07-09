<?php

namespace App\Repositories;

use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    public function toggle(Post $post, int $userId): void
    {
        $like = $post->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
        } else {
            $post->likes()->create(['user_id' => $userId]);
        }
    }
}
