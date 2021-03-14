<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Factories\Interfaces\CountryFactoryInterface;
use App\Factories\Eloquent\CountryFactory;
use App\Factories\Interfaces\CustomerFactoryInterface;
use App\Factories\Eloquent\CustomerFactory;
use App\Factories\Interfaces\UserFactoryInterface;
use App\Factories\Eloquent\UserFactory;

class FactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CustomerFactoryInterface::class, CustomerFactory::class);
        $this->app->bind(CountryFactoryInterface::class, CountryFactory::class);
        $this->app->bind(UserFactoryInterface::class, UserFactory::class);
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
