<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * @var PostService Layanan untuk mengelola data Post
     */
    protected $postService;

    /**
     * Konstruktor untuk menginisialisasi PostService
     *
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Menampilkan daftar semua postingan.
     *
     * Metode ini memanggil layanan postService untuk mengambil semua data
     * postingan dan mengembalikannya ke tampilan 'posts.index'.
     *
     * @return \Illuminate\View\View Tampilan halaman daftar postingan.
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        return view('posts.index', compact('posts'));
    }

    /**
     * Menampilkan halaman untuk membuat postingan baru.
     *
     * Metode ini mengembalikan tampilan 'posts.create' yang berisi
     * formulir untuk membuat postingan baru.
     *
     * @return \Illuminate\View\View Tampilan halaman pembuatan postingan.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Menyimpan postingan baru ke dalam database.
     *
     * Metode ini memvalidasi data yang diterima dari permintaan,
     * lalu memanggil layanan postService untuk menyimpan data postingan.
     *
     * @param \Illuminate\Http\Request $request Objek permintaan yang berisi data postingan.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar postingan dengan pesan sukses.
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $this->postService->store($request->only('caption', 'image'));

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupload!');
    }

    /**
     * Menampilkan halaman untuk mengedit postingan.
     *
     * Metode ini memeriksa otorisasi pengguna untuk memperbarui postingan,
     * lalu mengembalikan tampilan 'posts.edit' yang berisi formulir untuk
     * mengedit postingan.
     *
     * @param \App\Models\Post $post Objek postingan yang akan diedit.
     * @return \Illuminate\View\View Tampilan halaman pengeditan postingan.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Memperbarui data postingan yang ada.
     *
     * Metode ini memeriksa otorisasi pengguna untuk memperbarui postingan,
     * memvalidasi data yang diterima dari permintaan, lalu memanggil layanan
     * postService untuk memperbarui data postingan.
     *
     * @param \Illuminate\Http\Request $request Objek permintaan yang berisi data postingan.
     * @param \App\Models\Post $post Objek postingan yang akan diperbarui.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar postingan dengan pesan sukses.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $this->postService->update($post, $request->only('caption'));

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    /**
     * Menghapus sebuah post dari database.
     *
     * @param Post $post Instance dari model Post yang akan dihapus.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar post dengan pesan sukses.
     * 
     * @throws \Illuminate\Auth\Access\AuthorizationException Jika pengguna tidak memiliki izin untuk menghapus post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postService->destroy($post);

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

}
