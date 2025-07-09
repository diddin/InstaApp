<?php

namespace App\Services;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostService
{
    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function getAll()
    {
        return $this->postRepo->getAllWithRelations();
    }

    public function store(array $data)
    {
        $data['image'] = $data['image']->store('images', 'public');
        return $this->postRepo->create($data);
    }

    public function update(Post $post, array $data)
    {
        return $this->postRepo->update($post, $data);
    }

    public function destroy(Post $post)
    {
        return $this->postRepo->delete($post);
    }

    public function getDetailWithRelations(Post $post): Post
    {
        return $this->postRepo->findWithRelations($post);
    }

}
