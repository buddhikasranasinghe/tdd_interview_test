<?php

namespace App\Services;

use App\Contracts\SubscribeContract;
use App\Models\SubscribeWebsite;
use Exception;

class SubscribeService implements SubscribeContract
{
    public function storeSubscriber(array $subscriber): array
    {
        try {
            SubscribeWebsite::updateOrCreate([
                'website_id' => $subscriber['website_id'],
                'user_id' => $subscriber['user_id']
            ],[
                'website_id' => $subscriber['website_id'],
                'user_id' => $subscriber['user_id']
            ]);
            return ['success' => true, 'message' => 'Subscribed Successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
