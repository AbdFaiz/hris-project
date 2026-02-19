<?php

namespace App\Filament\Clusters\MasterOrganization;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class MasterOrganizationCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static string|UnitEnum|null $navigationGroup = 'Organization';

    public static function getNavigationLabel(): string
    {
        return __('Master Organization');
    }

    public static function getModelLabel(): string
    {
        return __('Master Organization');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Master Organizations');
    }

    // Kalau mau dikelompokkan lagi di bawah grup tertentu
    // protected static ?string $navigationGroup = 'Organization Settings';
}
