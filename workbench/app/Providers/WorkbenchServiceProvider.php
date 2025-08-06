<?php

namespace Workbench\App\Providers;

use Illuminate\Support\ServiceProvider;
use Workbench\Database\Seeders\WorkbenchDatabaseSeeder;

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
        $this->app->singleton('seeder', function ($app) {
            return new WorkbenchDatabaseSeeder();
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
