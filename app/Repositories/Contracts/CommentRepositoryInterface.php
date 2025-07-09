<?php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface CommentRepositoryInterface
{
    public function create(Post $post, array $data);
}
