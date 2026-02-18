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

    protected static ?string $navigationLabel = 'Master Organization';

    // Kalau mau dikelompokkan lagi di bawah grup tertentu
    // protected static ?string $navigationGroup = 'Organization Settings';
}
