<?php

namespace Tests\Feature;

use App\Jobs\PostMailJob;
use App\Models\Post;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
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
        $this->usersCanSubscribeWebPage();
        $users = $this->websiteUsersAbleToPostPosts($post_data);
        // $this->sendEmailToSubscribers($users['users']);
    }

    public function usersCanSubscribeWebPage()
    {
        $this->usersCanViewWebsites();
        $data = [
            'website_id' => 1,
            'email' => 'test@gmail.com'
        ];
        $response = $this->postJson('api/subscribe', $data);
        $response->assertStatus(201)->assertJson([
            'message' =>'Subscribed Successfully'
        ]);
    }

    public function usersCanViewWebsites()
    {
        $response = $this->getJson('api/websites');
        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'data'
        ]);
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
        Queue::fake();
        Queue::assertPushed(PostMailJob::class);
        foreach ($users as $email) {
            // Mail::fake();
            Mail::assertSent(PostMail::class, function($mail) use($email) {
                return $mail->to == $email;
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
