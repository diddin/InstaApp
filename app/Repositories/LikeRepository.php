<?php

namespace App\Repositories;

use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Models\Post;

class LikeRepository implements LikeRepositoryInterface
{
    /**
     * Menambah atau menghapus like dari pengguna pada sebuah postingan.
     *
     * Jika pengguna sudah menyukai postingan, maka like akan dihapus (unlike).
     * Jika belum, maka like akan ditambahkan.
     *
     * @param \App\Models\Post $post Postingan yang akan dilike atau di-unlike
     * @param int $userId ID pengguna yang melakukan aksi like/unlike
     * @return bool True jika berhasil like, False jika berhasil unlike
     */
    public function toggle(Post $post, int $userId): bool
    {
        $like = $post->likes()->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
            return false; // unliked
        } else {
            $post->likes()->create(['user_id' => $userId]);
            return true; // liked
        }
    }
}
