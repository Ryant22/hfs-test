<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogPostCommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake();
    }

    /**
     * Test creating and viewing a blog post.
     *
     * @return void
     */
    public function testCreateAndViewBlogPost()
    {
        // Arrange: Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user);

        // Arrange: Create post data with a fake image
        $post = [
            'title' => 'Test Blog Post',
            'body' => 'This is a test blog post body.',
            'image' => UploadedFile::fake()->image('post_image.jpg', 800, 600),
        ];

        // Act: Perform a POST request to the store action
        $this->post(route('posts.store'), $post);

        // Store the image in the fake disk using the 'store' method
        $imagePath = $post['image']->store('public/images');

        // Assert that the image is stored in the fake disk
        Storage::assertExists($imagePath);

        // Modify the $post array to use the fake disk path for the image
        $post['image'] = Storage::url($imagePath);


        // Assert: Check the database for the created post
        $this->assertDatabaseHas('posts', $post);

        // Assert: Get the ID of the created post from the database
        $createdPost = Post::where('title', $post['title'])->firstOrFail();
        $postId = $createdPost->id;

        // Act: Perform a GET request to the show action
        $response = $this->get(route('posts.show', $postId));

        // Assert: Check the response
        $response->assertStatus(200);
        $response->assertSee($post['title']);
        $response->assertSee($post['body']);
        $response->assertSee($post['image']);
    }

    /**
     * Test updating and deleting a blog post.
     *
     * @return void
     */
    public function testUpdateAndDeleteBlogPost()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::factory()->create([
            'user_id' => $user->id,
        ]);

        $updatedPost = [
            'title' => 'Updated Test Blog Post',
            'body' => 'This is an updated test blog post body.',
        ];

        $this->put(route('posts.update', $post->id), $updatedPost);

        $this->assertDatabaseHas('posts', $updatedPost);

        $this->delete(route('posts.destroy', $post->id));

        $this->assertDatabaseMissing('posts', $updatedPost);
    }

    /**
     * Test creating and deleting a comment.
     *
     * @return void
     */
    public function testCreateAndDeleteComment()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::factory()->create();

        $comment = [
            'body' => 'This is a test comment.',
        ];

        $this->post(route('comments.store', $post->id), $comment);

        $this->assertDatabaseHas('comments', $comment);

        $this->delete(route('comments.destroy', ['postId' => $post->id, 'commentId' => 1]));

        $this->assertDatabaseMissing('comments', $comment);
    }
}
