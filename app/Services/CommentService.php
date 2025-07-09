<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentService
{
    public function __construct(protected CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function addComment(Post $post, array $data)
    {
        $data['user_id'] = Auth::user()->id;
        return $this->commentRepository->create($post, $data);
    }

    public function findByPostAndId(Post $post, int $commentId): Comment
    {
        return $this->commentRepository->findByPostAndId($post, $commentId);
    }

    public function paginateByPost(Post $post, int $perPage = 10): LengthAwarePaginator
    {
        return $this->commentRepository->paginateByPost($post, $perPage);
    }
}
