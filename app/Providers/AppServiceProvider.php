<?php

namespace App\Providers;

use App\System\Oxford\Client\GuzzleClient;
use App\System\Oxford\v2\Dictionary;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Dictionary::class, function () {
            $client = new GuzzleClient(
                env('DICTIONARY_ENDPOINT'),
                env('DICTIONARY_APP_ID'),
                env('DICTIONARY_APP_KEY')
            );

            return new Dictionary($client);
        });
    }
}
