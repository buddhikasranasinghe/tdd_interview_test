<?php

namespace App\Services;

use App\Contracts\PostContract;
use App\Jobs\PostMailJob;
use App\Models\Post;
use App\Models\User;
use Exception;

class PostService implements PostContract
{
    public function addPost(array $postData): array
    {
        try {
            Post::create($postData);
            return ['success' => true, 'message' => 'Post Created'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getSubscribeUsers(int $websiteId): array
    {
        try {
            $users = User::
            whereHas('subscribeWebsites', function($query) use($websiteId) {
                $query->where('website_id', $websiteId);
            })->pluck('email');
            return ['success' => true, 'users' => $users];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function sendMails(array $mailContent, array $users): void
    {
        dispatch(new PostMailJob($mailContent, $users));
    }
}
