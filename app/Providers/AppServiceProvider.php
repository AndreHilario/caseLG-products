<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\Products\ProductRepository::class,
            \App\Repositories\Products\ProductRepository::class
        );
        $this->app->bind(
            \App\Services\Products\ProductService::class,
            \App\Services\Products\ProductService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
