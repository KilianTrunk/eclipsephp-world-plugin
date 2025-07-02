<?php

namespace Eclipse\World\Filament\Clusters\World\Resources\PostResource\Pages;

use Eclipse\World\Filament\Clusters\World\Resources\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
