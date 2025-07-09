<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $posts = \App\Models\Post::with(['user', 'likes', 'comments'])->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('image')->store('images', 'public');

        Auth::user()->posts()->create([
            'caption' => $request->caption,
            'image' => $path,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diupload!');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $post->update([
            'caption' => $request->caption,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post berhasil dihapus.');
    }

}
