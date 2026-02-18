<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages\CreateEchelon;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages\EditEchelon;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages\ListEchelons;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages\ViewEchelon;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Schemas\EchelonForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Schemas\EchelonInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Tables\EchelonsTable;
use App\Models\Organization\Echelon;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EchelonResource extends Resource
{
    protected static ?string $model = Echelon::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EchelonForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EchelonInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EchelonsTable::configure($table);
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
            'index' => ListEchelons::route('/'),
            'create' => CreateEchelon::route('/create'),
            'view' => ViewEchelon::route('/{record}'),
            'edit' => EditEchelon::route('/{record}/edit'),
        ];
    }
}
