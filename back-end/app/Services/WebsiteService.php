<?php

namespace App\Services;

use App\Contracts\WebsiteContract;
use App\Models\Website;
use Exception;

class WebsiteService implements WebsiteContract
{
    public function getWebsites(): array
    {
        try {
            $websites = Website::select(['id', 'domain'])->get();
            return ['success' => true, 'message' => $websites];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
