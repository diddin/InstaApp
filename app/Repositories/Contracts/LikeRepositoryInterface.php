<?php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface LikeRepositoryInterface
{
    public function toggle(Post $post, int $userId): bool;
}
