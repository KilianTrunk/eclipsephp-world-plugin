<?php

namespace Eclipse\World\Filament\Clusters\World\Resources\PostResource\Pages;

use Eclipse\World\Filament\Clusters\World\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
