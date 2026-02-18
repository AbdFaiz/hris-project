<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Pages\CreateRegion;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Pages\EditRegion;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Pages\ListRegions;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Pages\ViewRegion;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Schemas\RegionForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Schemas\RegionInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Tables\RegionsTable;
use App\Models\Organization\Region;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RegionResource extends Resource
{
    protected static ?string $model = Region::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return RegionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RegionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RegionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRegions::route('/'),
            'create' => CreateRegion::route('/create'),
            'view' => ViewRegion::route('/{record}'),
            'edit' => EditRegion::route('/{record}/edit'),
        ];
    }
}
