<?php

namespace Eclipse\World\Jobs;

use Eclipse\World\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCountries implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        // Load existing countries into an associative array
        $existingCountries = Country::withTrashed()->get()->keyBy('id');

        // Load new country data
        $countries = json_decode(file_get_contents('https://raw.githubusercontent.com/mledoze/countries/master/dist/countries.json'), true);

        foreach ($countries as $rawData) {
            if (! $rawData['independent']) {
                continue;
            }

            $data = [
                'id' => $rawData['cca2'],
                'a3_id' => $rawData['cca3'],
                'num_code' => $rawData['ccn3'],
                'name' => $rawData['name']['common'],
                'flag' => $rawData['flag'],
            ];

            if (isset($existingCountries[$data['id']])) {
                $existingCountries[$data['id']]->update($data);
            } else {
                Country::create($data);
            }
        }
    }
}
