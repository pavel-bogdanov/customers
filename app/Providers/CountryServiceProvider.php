<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RestCountriesEuService;
use App\Services\Interfaces\CountryServiceInterface;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CountryServiceInterface::class, RestCountriesEuService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
