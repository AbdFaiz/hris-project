<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages\CreatePosition;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages\EditPosition;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages\ListPositions;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages\ViewPosition;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Schemas\PositionForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Schemas\PositionInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Tables\PositionsTable;
use App\Models\Organization\Position;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PositionResource extends Resource
{
    protected static ?string $model = Position::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PositionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PositionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PositionsTable::configure($table);
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
            'index' => ListPositions::route('/'),
            'create' => CreatePosition::route('/create'),
            'view' => ViewPosition::route('/{record}'),
            'edit' => EditPosition::route('/{record}/edit'),
        ];
    }
}
