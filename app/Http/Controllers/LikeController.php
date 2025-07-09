<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(\App\Models\Post $post)
    {
        $like = $post->likes()->where('user_id', Auth::user()->id)->first();

        if ($like) {
            $like->delete(); // Unlike
        } else {
            $post->likes()->create(['user_id' => Auth::user()->id]);
        }

        return back();
    }
}
