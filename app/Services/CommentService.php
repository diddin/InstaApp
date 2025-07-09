<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;


class CommentService
{
    /**
     * Konstruktor untuk CommentService.
     *
     * @param CommentRepositoryInterface $commentRepository Repository untuk mengelola data komentar.
     */
    public function __construct(protected CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Menambahkan komentar baru pada sebuah post.
     *
     * @param \App\Models\Post $post Post yang akan dikomentari
     * @param array $data Data komentar yang akan disimpan (hanya 'content')
     * @return \App\Models\Comment Komentar yang berhasil dibuat
     */
    public function addComment(Post $post, array $data)
    {
        $data['user_id'] = Auth::user()->id;
        return $this->commentRepository->create($post, $data);
    }

    /**
     * Mengambil komentar berdasarkan ID dan post terkait.
     *
     * @param \App\Models\Post $post Post yang menjadi induk komentar
     * @param int $commentId ID dari komentar yang ingin diambil
     * @return \App\Models\Comment Komentar yang ditemukan, atau gagal jika tidak ditemukan (akan throw ModelNotFoundException)
     */
    public function findByPostAndId(Post $post, int $commentId): Comment
    {
        return $this->commentRepository->findByPostAndId($post, $commentId);
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
        return $this->commentRepository->paginateByPost($post, $perPage);
    }
}
