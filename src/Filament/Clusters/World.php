<?php

namespace Eclipse\World\Filament\Clusters;

use Filament\Clusters\Cluster;

class World extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-s-map';

    protected static ?string $navigationGroup = 'Configuration';

    public static function getNavigationLabel(): string
    {
        return __('eclipse-world::cluster.label');
    }

    public static function getClusterBreadcrumb(): ?string
    {
        return self::getNavigationLabel();
    }
}
