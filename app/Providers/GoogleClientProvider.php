<?php

namespace App\Providers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class GoogleClientProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton(Google_Client::class, function ($app) {
            $client = new \Google_Client();
            \Storage::disk('local')->put('client_secret.json', json_encode([
                'web' => config('services.google')
            ]));
            $client->setAuthConfig(\Storage::path('client_secret.json'));
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
            $client->addScope(Google_Service_Drive::DRIVE);
            $client->setRedirectUri(env('GOOGLE_REDIRECT'));

            return $client;
        });
    }
}
