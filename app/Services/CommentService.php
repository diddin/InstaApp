<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;


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
}
