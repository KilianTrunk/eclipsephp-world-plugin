<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Workbench\Database\Seeders\WorkbenchDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the workbench database seeder
        $this->call(WorkbenchDatabaseSeeder::class);
    }
}
