<?php

namespace App\Providers;

use App\Contracts\PostContract;
use App\Contracts\SubscribeContract;
use App\Contracts\UserContract;
use App\Contracts\WebsiteContract;
use App\Services\PostService;
use App\Services\SubscribeService;
use App\Services\UserService;
use App\Services\WebsiteService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
        $this->app->bind(PostContract::class, PostService::class);
        $this->app->bind(SubscribeContract::class, SubscribeService::class);
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(WebsiteContract::class, WebsiteService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
