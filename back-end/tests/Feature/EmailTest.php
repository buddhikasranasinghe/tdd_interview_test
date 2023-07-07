<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function subscribeUsersCanReceiveEmails(): void
    {
        $post_data = $this->postData();
        $users = $this->websiteUsersAbleToPostPosts($post_data);
        // $this->sendEmailToSubscribers($users['users']);
    }

    public function websiteUsersAbleToPostPosts(array $post): array
    {
        $this->titleValidation($post);
        $this->descriptionValidation($post);
        $this->websiteIdValidation($post);
        $response = $this->postJson('api/post', $post);
        $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
            'users' => [
                'success',
                'users'
            ]
        ]);
        $this->assertDatabaseHas('posts', $post);
        return $response['users'];
    }

    public function titleValidation(array $post): void 
    {
        $post['title'] = '';        
        $response = $this->postJson('api/post', $post);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'title',
            ]
        ]);
    }
    
    public function descriptionValidation(array $post): void 
    {
        $post['description'] = '';        
        $response = $this->postJson('api/post', $post);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'description',
            ]
        ]);
    }
    
    public function websiteIdValidation(array $post): void 
    {
        $post['website_id'] = '';        
        $response = $this->postJson('api/post', $post);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'website_id',
            ]
        ]);
    }

    public function sendEmailToSubscribers(array $users): void
    {
        foreach ($users as $email) {
            Mail::fake();
            Mail::assertSent(PostMail::class, function($mail) use($email) {
                return $mail->hasTo($email);
            });   
        }
    }

    public function postData(): array
    {
        $random_website = Website::inRandomOrder()->first();
        return [
            'title' => 'test title',
            'description' => 'test description',
            'website_id' => $random_website->id
        ];
    }

}
