<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    
    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => 'required']);

        $this->commentService->addComment($post, $request->only('content'));

        // $post->comments()->create([
        //     'user_id' => Auth::user()->id,
        //     'content' => $request->content,
        //     'post_id' => $post->id,
        // ]);

        return back();
    }
}
