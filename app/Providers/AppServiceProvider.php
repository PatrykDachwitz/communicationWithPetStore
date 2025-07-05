<?php

namespace App\Providers;

use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Api\Pet\PetInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app
            ->singleton(
                PetInterface::class,
                Pet::class
            );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
