<?php

namespace App\Providers;

use App\Contracts\ConnectionRepositoryInterface;
use App\Repositories\ConnectionsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ConnectionRepositoryInterface::class,
            ConnectionsRepository::class,
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
