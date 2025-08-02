<?php

namespace Eclipse\World\Jobs;

use Eclipse\Common\Foundation\Jobs\QueueableJob;
use Eclipse\World\Models\Country;
use Eclipse\World\Models\Post;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Throwable;

class ImportPosts extends QueueableJob
{
    private const string OPENDATASOFT_RECORDS_API_URL = 'https://data.opendatasoft.com/api/records/1.0/';

    public string $countryId;

    public function __construct(string $countryId, string $locale = null)
    {
        $this->countryId = $countryId;

        parent::__construct($locale);
    }

    protected function execute(): void
    {
        if (! in_array($this->countryId, ['SI', 'HR'])) {
            throw new InvalidArgumentException("Country $this->countryId not supported for import");
        }

        $batchSize = 1000;
        $offset = 0;
        $processedCodes = [];

        Log::info("Starting postal data import for country: $this->countryId");

        do {
            [$totalRecords, $records] = $this->getData($batchSize, $offset);

            foreach ($records as $record) {
                [$postalCode, $placeName] = $this->getRecordData($record);

                if (array_key_exists($postalCode, $processedCodes)) {
                    continue;
                }

                $processedCodes[$postalCode] = true;

                $existingPost = Post::where('country_id', $this->countryId)
                    ->where('code', $postalCode)
                    ->first();

                if (empty($existingPost)) {
                    Post::create([
                        'country_id' => $this->countryId,
                        'code' => $postalCode,
                        'name' => $placeName,
                    ]);
                } elseif ($existingPost->name !== $placeName) {
                    $existingPost->update(['name' => $placeName]);
                }
            }

            $offset += $batchSize;
        } while ($offset < $totalRecords);
    }

    /**
     * Get data from the external API
     *
     * @throws Throwable
     */
    private function getData(int $batchSize, int $offset): array
    {
        $url = self::OPENDATASOFT_RECORDS_API_URL
            .'search/?dataset=geonames-postal-code@public'
            .'&q='
            ."&rows=$batchSize"
            ."&start=$offset"
            .'&sort=postal_code'
            ."&refine.country_code=$this->countryId";

        $response = Http::get($url);

        if (! $response->successful()) {
            throw new Exception('Failed to fetch data from Opendatasoft API: '.$response->status());
        }

        $data = $response->json();

        if (empty($data)) {
            throw new Exception('Empty data set received from Opendatasoft API');
        }

        return [
            $data['nhits'],
            $data['records'],
        ];
    }

    /**
     * Extract code and name from record based on country
     */
    private function getRecordData(array $record): array
    {
        return match ($this->countryId) {
            'HR' => [
                $record['fields']['postal_code'],
                $record['fields']['admin_name3'],
            ],
            default => [
                $record['fields']['postal_code'],
                $record['fields']['place_name'],
            ],
        };
    }

    protected function getJobName(): string
    {
        return __('eclipse-world::posts.import.job_name', [], $this->locale);
    }

    protected function getNotificationBody(): string
    {
        return __("eclipse-world::posts.notifications.{$this->status->value}.message", [
            'country' => Country::find($this->countryId)?->name ?? $this->countryId,
        ], $this->locale);
    }
}
