<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Models\Post;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(Post $post, array $data)
    {
        return $post->comments()->create($data);
    }
}
