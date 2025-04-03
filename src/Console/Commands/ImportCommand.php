<?php

namespace Eclipse\World\Console\Commands;

use Eclipse\World\Jobs\ImportCountries;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    protected $signature = 'world:import';

    protected $description = 'Run the import command for world data';

    public function handle(): void
    {
        $this->info('Import command started');

        // Run ImportCountries job
        ImportCountries::dispatchSync();

        $this->info('Import command ran successfully');
    }
}
