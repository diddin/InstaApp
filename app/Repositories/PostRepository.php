<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * Mengambil semua postingan beserta relasi user, like, dan komentar.
     *
     * @return \Illuminate\Database\Eloquent\Collection Daftar semua postingan dengan relasi yang telah dimuat
     */
    public function getAllWithRelations()
    {
        return Post::with(['user', 'likes', 'comments'])->latest()->get();
    }

    /**
     * Membuat postingan baru oleh pengguna yang sedang login.
     *
     * @param array $data Data postingan yang berisi 'caption' dan 'image'
     * @return \App\Models\Post Postingan yang berhasil dibuat
     */
    public function create(array $data)
    {
        return Auth::user()->posts()->create($data);
    }

    /**
     * Memperbarui data sebuah postingan.
     *
     * @param \App\Models\Post $post Postingan yang akan diperbarui
     * @param array $data Data yang akan diperbarui (misalnya caption)
     * @return bool True jika pembaruan berhasil, false jika gagal
     */
    public function update(Post $post, array $data)
    {
        return $post->update($data);
    }

    /**
     * Menghapus sebuah postingan beserta gambar yang terkait dari storage (jika ada).
     *
     * @param \App\Models\Post $post Postingan yang akan dihapus
     * @return bool True jika berhasil dihapus, false jika gagal
     */
    public function delete(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        return $post->delete();
    }

    /**
     * Mengambil detail postingan beserta relasi user, like, dan komentar (terurut terbaru).
     *
     * @param \App\Models\Post $post Postingan yang akan dimuat relasinya
     * @return \App\Models\Post Postingan dengan relasi yang telah dimuat (lazy-loaded)
     */
    public function findWithRelations(Post $post): Post
    {
        return $post->load([
            'user',
            'likes',
            'comments' => fn($q) => $q->latest()->with('user')
        ]);
    }
}
