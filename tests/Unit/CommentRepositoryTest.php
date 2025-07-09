<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Repositories\CommentRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected CommentRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new CommentRepository();
    }

    public function test_create_comment_for_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $comment = $this->repository->create($post, [
            'user_id' => $user->id,
            'content' => 'Ini komentar dari unit test',
        ]);

        $this->assertInstanceOf(Comment::class, $comment);
        $this->assertEquals('Ini komentar dari unit test', $comment->content);
        $this->assertEquals($user->id, $comment->user_id);
        $this->assertEquals($post->id, $comment->post_id);
    }

    public function test_find_by_post_and_id()
    {
        $comment = Comment::factory()->create();

        $found = $this->repository->findByPostAndId($comment->post, $comment->id);

        $this->assertInstanceOf(Comment::class, $found);
        $this->assertEquals($comment->id, $found->id);
    }

    public function test_paginate_by_post()
    {
        $post = Post::factory()->create();
        Comment::factory()->count(15)->create([
            'post_id' => $post->id,
        ]);

        $pagination = $this->repository->paginateByPost($post, 10);

        $this->assertEquals(10, $pagination->count());
        $this->assertEquals(2, $pagination->lastPage());
    }
}
