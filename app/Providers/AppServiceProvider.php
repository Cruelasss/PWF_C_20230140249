<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;
use App\Models\User;

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
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('viewApiDocs', function () {
            return true;
        });

        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });
    }
}