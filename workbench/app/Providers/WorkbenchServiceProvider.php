<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;
use Workbench\Database\Seeders\DatabaseSeeder;

class WorkbenchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(AdminPanelProvider::class);
        
        // Register the DatabaseSeeder with the proper namespace
        $this->app->singleton('seeder', function ($app) {
            return new DatabaseSeeder();
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
