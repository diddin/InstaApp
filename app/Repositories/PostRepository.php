<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAllWithRelations()
    {
        return Post::with(['user', 'likes', 'comments'])->latest()->get();
    }

    public function create(array $data)
    {
        return Auth::user()->posts()->create($data);
    }

    public function update(Post $post, array $data)
    {
        return $post->update($data);
    }

    public function delete(Post $post)
    {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        return $post->delete();
    }

    public function findWithRelations(Post $post): Post
    {
        return $post->load([
            'user',
            'likes',
            'comments' => fn($q) => $q->latest()->with('user')
        ]);
    }
}
