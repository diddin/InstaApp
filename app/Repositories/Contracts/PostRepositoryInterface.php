<?php

namespace App\Repositories\Contracts;

use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAllWithRelations();
    public function create(array $data);
    public function update(Post $post, array $data);
    public function delete(Post $post);
}
