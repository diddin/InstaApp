<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected PostRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new PostRepository();
        Storage::fake('public');
    }

    public function test_it_can_get_all_posts_with_relations()
    {
        Post::factory()->count(3)->create();

        $posts = $this->repository->getAllWithRelations();

        $this->assertCount(3, $posts);
        $this->assertTrue($posts->first()->relationLoaded('user'));
    }

    public function test_it_can_create_post()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $image = UploadedFile::fake()->image('test.jpg');

        $post = $this->repository->create([
            'caption' => 'Testing caption',
            'image' => $image->store('images', 'public'),
        ]);

        $this->assertDatabaseHas('posts', ['caption' => 'Testing caption']);
        $this->assertEquals($user->id, $post->user_id);
    }

    public function test_it_can_update_post()
    {
        $post = Post::factory()->create(['caption' => 'Before']);

        $result = $this->repository->update($post, ['caption' => 'After']);

        $this->assertTrue($result);
        $this->assertEquals('After', $post->fresh()->caption);
    }

    public function test_it_can_delete_post_and_image()
    {
        $imagePath = 'images/fake.jpg';
        Storage::disk('public')->put($imagePath, 'dummy');

        $post = Post::factory()->create(['image' => $imagePath]);

        $result = $this->repository->delete($post);

        $this->assertTrue($result);
        Storage::disk('public')->assertMissing($imagePath);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_it_can_find_post_with_relations()
    {
        $post = Post::factory()->create();

        $result = $this->repository->findWithRelations($post);

        $this->assertEquals($post->id, $result->id);
        $this->assertTrue($result->relationLoaded('comments'));
        $this->assertTrue($result->relationLoaded('user'));
        $this->assertTrue($result->relationLoaded('likes'));
    }
}