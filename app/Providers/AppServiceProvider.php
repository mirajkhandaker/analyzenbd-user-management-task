<?php

namespace App\Providers;

use App\Interfaces\FileInterface;
use App\Interfaces\UserInterface;
use App\Services\FileService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserService::class);
        $this->app->bind(FileInterface::class, FileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Facades\View::composer('*', function (View $view) {
            $view->with('routeName', Route::currentRouteName());
        });
    }
}
