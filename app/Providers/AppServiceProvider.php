<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Laravel\Passport\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Igoring Passport default migrations to change clients to use UUIDs
         * Using UUIDS over incrementing ids serves 2 reasons:
         * 1. Avoid clearly showing sequential client identifiers
         * 2. in almost all cases, inserts perform better using UUIDs
         */
        Passport::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /**
         * Override Client creating and retrieved from default Passport Client Model
         * We want to avoid Laravel trying to increment the primary key
         * We also need a 3rd. party lib to generate the UUID, as Laravel doesn't support it natively
         * Using another DB than MySQL could allow you to avoid using 3rd. party libs to generate UUID
         * ramsey lib for uuid: https://github.com/ramsey/uuid
         */
        Client::creating(function (Client $client) {
            $client->incrementing = false;
            $client->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        });

        /**
         * Setting incrementing = false
         * Ensuring Laravel is not trying to cast the UUID to an int when getting the model
         */
        Client::retrieved(function (Client $client) {
            $client->incrementing = false;
        });
    }
}
