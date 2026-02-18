<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages\CreateDivision;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages\EditDivision;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages\ListDivisions;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages\ViewDivision;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Schemas\DivisionForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Schemas\DivisionInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Tables\DivisionsTable;
use App\Models\Organization\Division;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DivisionResource extends Resource
{
    protected static ?string $model = Division::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DivisionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DivisionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DivisionsTable::configure($table);
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
            'index' => ListDivisions::route('/'),
            'create' => CreateDivision::route('/create'),
            'view' => ViewDivision::route('/{record}'),
            'edit' => EditDivision::route('/{record}/edit'),
        ];
    }
}
