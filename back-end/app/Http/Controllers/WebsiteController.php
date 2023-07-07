<?php

namespace App\Http\Controllers;

use App\Contracts\WebsiteContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    protected $websiteContract;

    public function __construct(WebsiteContract $websiteContract)
    {
        $this->websiteContract = $websiteContract;
    }

    public function index(): JsonResponse
    {
        return response()->json(['status' => true, 'data' => $this->websiteContract->getWebsites()], 200);
    }
}
