<?php

namespace Eclipse\World\Jobs;

use Eclipse\Common\Foundation\Jobs\QueueableJob;
use Eclipse\World\Models\Country;
use Exception;

class ImportCountries extends QueueableJob
{
    public int $timeout = 60;

    public bool $failOnTimeout = true;

    protected function execute(): void
    {
        // Load existing countries into an associative array
        $existingCountries = Country::withTrashed()->get()->keyBy('id');

        // Load new country data
        $countries = json_decode(file_get_contents('https://raw.githubusercontent.com/mledoze/countries/master/dist/countries.json'), true);

        if (! $countries) {
            throw new Exception('Failed to fetch or parse countries data');
        }

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

    protected function getJobName(): string
    {
        return __('eclipse-world::countries.import.job_name', [], $this->locale);
    }

    protected function getNotificationTitle(): string
    {
        return __("eclipse-world::countries.notifications.{$this->status->value}.title", [], $this->locale);
    }
}
