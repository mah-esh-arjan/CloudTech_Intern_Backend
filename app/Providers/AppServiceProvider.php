<?php

namespace App\Providers;

use App\Models\Customer;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin',function(Customer $role){
            return $role->role ==='admin';
        });

        Gate::define('isClient',function(Customer $role){
            return $role->role === 'client';
        });

        Gate::define('isReader',function(Customer $role){
            return $role->role === 'reader';
        });

    }
    
}
