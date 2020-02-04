<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use app\Http\Middleware\HandleOAuthErrors;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HandleOAuthErrors::class, function () {
            return new \App\Http\Middleware\HandleOAuthErrors;
        });
    }

    /**
     * Bootstrap any application services.
     *
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
