<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\LikeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    protected $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function toggle(Post $post)
    {
        $userId = Auth::user()->id;
        $this->likeRepository->toggle($post, $userId);
    }
}
