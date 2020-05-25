<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use App\Client;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Registering the default routes set by passport to serve default endpoints
         * see: https://laravel.com/docs/7.x/passport
         */
        Passport::routes();

        /**
         * No reason to expose we're using Laravel to serve content
         * Overriding the cookie set by CreateFreshApiToken in web middleware group in Http/Kernel.php
         * see: https://laravel.com/docs/7.x/passport#consuming-your-api-with-javascript
         */
        Passport::cookie('internal_token');
    }
}
