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
    
    /**
     * Menyimpan komentar baru pada postingan tertentu.
     *
     * @param \Illuminate\Http\Request $request Objek request HTTP yang berisi data komentar.
     * @param \App\Models\Post $post Postingan yang akan dikomentari.
     * @return \Illuminate\Http\RedirectResponse Redirect kembali ke halaman sebelumnya setelah komentar disimpan.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => 'required']);

        $this->commentService->addComment($post, $request->only('content'));

        return back();
    }
}
