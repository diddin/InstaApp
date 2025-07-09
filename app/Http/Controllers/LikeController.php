<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\LikeService;

class LikeController extends Controller
{
    protected $likeService;

    /**
     * Konstruktor LikeController.
     *
     * @param LikeService $likeService Service yang bertanggung jawab untuk menangani operasi terkait suka.
     */
    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    /**
     * Mengubah status suka untuk sebuah postingan.
     *
     * Metode ini menggunakan likeService untuk mengubah status suka
     * dari postingan yang ditentukan. Setelah diubah, pengguna akan
     * diarahkan kembali ke halaman sebelumnya.
     *
     * @param \App\Models\Post $post Instance postingan yang status sukanya akan diubah.
     * @return \Illuminate\Http\RedirectResponse Mengarahkan kembali ke halaman sebelumnya.
     */
    public function toggle(Post $post)
    {
        $this->likeService->toggle($post);

        return back();
    }
}
