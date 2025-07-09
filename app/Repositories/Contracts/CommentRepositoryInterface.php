<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use App\Models\Comment;

interface CommentRepositoryInterface
{
    public function create(Post $post, array $data);
    public function findByPostAndId(Post $post, int $commentId): Comment;
    public function paginateByPost(Post $post, int $perPage = 10): \Illuminate\Pagination\LengthAwarePaginator;
}
