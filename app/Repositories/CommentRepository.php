<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post;
use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    /**
     * Membuat komentar baru pada sebuah postingan.
     *
     * @param \App\Models\Post $post Postingan yang dikomentari
     * @param array $data Data komentar yang berisi 'content' dan 'user_id'
     * @return \App\Models\Comment Komentar yang berhasil dibuat
     */
    public function create(Post $post, array $data)
    {
        return $post->comments()->create($data);
    }
    
    /**
     * Mengambil komentar berdasarkan ID dan post terkait.
     *
     * @param \App\Models\Post $post Post yang menjadi induk komentar
     * @param int $commentId ID dari komentar yang ingin diambil
     * @return \App\Models\Comment Komentar yang ditemukan, atau gagal jika tidak ditemukan (akan melempar ModelNotFoundException)
     */
    public function findByPostAndId(Post $post, int $commentId): Comment
    {
        return $post->comments()->where('id', $commentId)->firstOrFail();
    }

    /**
     * Mengambil daftar komentar untuk suatu post dengan pagination.
     *
     * @param \App\Models\Post $post Post yang ingin diambil komentarnya
     * @param int $perPage Jumlah komentar per halaman (default: 10)
     * @return \Illuminate\Pagination\LengthAwarePaginator Daftar komentar dalam bentuk paginasi
     */
    public function paginateByPost(Post $post, int $perPage = 10): LengthAwarePaginator
    {
        return $post->comments()
            ->with('user')
            ->latest()
            ->paginate($perPage);
    }
}
