<?php

namespace App\Providers;

use App\Contracts\Logger;
use App\Models\Customer;
use App\Services\DatabaseLogger;
use App\Services\LaravelLogger;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Logger::class, LaravelLogger::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isRole', function ($user, $role) {
            return $user->role === $role;
        });
    }
}
