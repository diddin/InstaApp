<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\LikeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    protected $likeRepository;

    /**
     * Membuat instance LikeService.
     *
     * @param \App\Repositories\Contracts\LikeRepositoryInterface $likeRepository
     *        Repository untuk pengelolaan data like.
     */
    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    /**
     * Mengaktifkan atau menonaktifkan (toggle) like pada sebuah post oleh pengguna saat ini.
     *
     * Jika pengguna sudah memberi like pada post, maka like akan dihapus (unlike).
     * Jika belum, maka like akan ditambahkan.
     *
     * @param \App\Models\Post $post Post yang akan dilike atau di-unlike
     * @return void
     */
    public function toggle(Post $post)
    {
        $userId = Auth::user()->id;
        $this->likeRepository->toggle($post, $userId);
    }
}
