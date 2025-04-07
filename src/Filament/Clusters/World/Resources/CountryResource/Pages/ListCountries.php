<?php

namespace Eclipse\World\Filament\Clusters\World\Resources\CountryResource\Pages;

use Eclipse\World\Filament\Clusters\World\Resources\CountryResource;
use Eclipse\World\Jobs\ImportCountries;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListCountries extends ListRecords
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('eclipse-world::countries.actions.create.label'))
                ->modalHeading(__('eclipse-world::countries.actions.create.heading')),
            Action::make('import_countries')
                ->label('Import countries')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () {
                    // Dispatch the job
                    ImportCountries::dispatch();

                    // Show notification
                    Notification::make()
                        ->title('Import Countries')
                        ->body('The import countries job has been queued.')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation(),
        ];
    }
}
