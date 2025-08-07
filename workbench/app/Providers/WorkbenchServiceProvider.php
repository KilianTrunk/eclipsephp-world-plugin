<?php

namespace App\World\Workbench\Providers;

use Illuminate\Support\ServiceProvider;
#use App\World\Workbench\Database\Seeders\WorkbenchDatabaseSeeder;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(AdminPanelProvider::class);
        $this->app->register(AuthServiceProvider::class);

        // Register the DatabaseSeeder with the proper namespace
        $this->app->bind(\Database\Seeders\DatabaseSeeder::class, function ($app) {
            return new \App\World\Workbench\Database\Seeders\DatabaseSeeder;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
