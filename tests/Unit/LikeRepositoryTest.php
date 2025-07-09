<?php

namespace Tests\Unit;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use App\Repositories\LikeRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected LikeRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new LikeRepository();
    }

    public function test_it_can_like_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        $result = $this->repository->toggle($post, $user->id);

        $this->assertTrue($result); // return true = liked
        $this->assertDatabaseHas('likes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_it_can_unlike_a_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create();

        // Sudah like duluan
        $post->likes()->create(['user_id' => $user->id]);

        $result = $this->repository->toggle($post, $user->id);

        $this->assertFalse($result); // return false = unlike
        $this->assertDatabaseMissing('likes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
        ]);
    }
}
