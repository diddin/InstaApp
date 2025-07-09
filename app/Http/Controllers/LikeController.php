<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    protected $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function toggle(Post $post)
    {
        // $like = $post->likes()->where('user_id', Auth::user()->id)->first();

        // if ($like) {
        //     $like->delete(); // Unlike
        // } else {
        //     $post->likes()->create(['user_id' => Auth::user()->id]);
        // }

        $this->likeService->toggle($post);

        return back();
    }
}
