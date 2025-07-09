<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(Post $post, array $data)
    {
        return $post->comments()->create($data);
    }

    public function findByPostAndId(Post $post, int $commentId): Comment
    {
        return $post->comments()->where('id', $commentId)->firstOrFail();
    }

    public function paginateByPost(Post $post, int $perPage = 10): LengthAwarePaginator
    {
        return $post->comments()
            ->with('user')
            ->latest()
            ->paginate($perPage);
    }

}
