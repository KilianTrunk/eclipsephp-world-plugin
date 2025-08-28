<?php

namespace Eclipse\World\Seeders;

use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CurrencySeeder::class);
    }
}
