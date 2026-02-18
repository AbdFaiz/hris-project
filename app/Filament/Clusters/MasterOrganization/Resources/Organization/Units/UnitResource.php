<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Units;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Pages\CreateUnit;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Pages\EditUnit;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Pages\ListUnits;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Pages\ViewUnit;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Schemas\UnitForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Schemas\UnitInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Tables\UnitsTable;
use App\Models\Organization\Unit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return UnitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UnitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnitsTable::configure($table);
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
            'index' => ListUnits::route('/'),
            'create' => CreateUnit::route('/create'),
            'view' => ViewUnit::route('/{record}'),
            'edit' => EditUnit::route('/{record}/edit'),
        ];
    }
}
