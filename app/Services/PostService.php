<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostService
{
    protected $postRepo;

    /**
     * Membuat instance dari PostService.
     *
     * @param \App\Repositories\Contracts\PostRepositoryInterface $postRepo
     *        Repository untuk pengelolaan data postingan.
     */
    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    /**
     * Mengambil semua postingan beserta relasi user, komentar, dan like.
     *
     * @return \Illuminate\Database\Eloquent\Collection Daftar semua postingan dengan relasi yang dimuat.
     */
    public function getAll()
    {
        return $this->postRepo->getAllWithRelations();
    }

    /**
     * Menyimpan postingan baru beserta gambar yang diunggah.
     *
     * @param array $data Data postingan yang berisi 'caption' dan file 'image'
     * @return \App\Models\Post Postingan yang berhasil disimpan
     */
    public function store(array $data)
    {
        $data['image'] = $data['image']->store('images', 'public');
        return $this->postRepo->create($data);
    }

    /**
     * Memperbarui data postingan.
     *
     * @param \App\Models\Post $post Postingan yang akan diperbarui
     * @param array $data Data yang akan diperbarui (misalnya caption)
     * @return \App\Models\Post Postingan setelah diperbarui
     */
    public function update(Post $post, array $data)
    {
        return $this->postRepo->update($post, $data);
    }

    /**
     * Menghapus postingan beserta gambar jika ada.
     *
     * @param \App\Models\Post $post Postingan yang akan dihapus
     * @return bool True jika berhasil dihapus, false jika gagal
     */
    public function destroy(Post $post)
    {
        return $this->postRepo->delete($post);
    }

    /**
     * Mengambil detail lengkap dari sebuah postingan beserta relasi-relasinya.
     *
     * Relasi yang dimuat biasanya meliputi user, komentar, dan like.
     *
     * @param \App\Models\Post $post Postingan yang ingin diambil detailnya
     * @return \App\Models\Post Postingan dengan relasi yang telah dimuat
     */
    public function getDetailWithRelations(Post $post): Post
    {
        return $this->postRepo->findWithRelations($post);
    }

}
