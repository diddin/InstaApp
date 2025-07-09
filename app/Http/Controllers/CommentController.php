<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, \App\Models\Post $post)
    {
        $request->validate(['content' => 'required']);
        $post->comments()->create([
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'post_id' => $post->id,
        ]);

        return back();
    }
}
