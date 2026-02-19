<?php

namespace App\Filament\Resources\Organization\Policies;

use App\Filament\Resources\Organization\Policies\Pages\CreatePolicy;
use App\Filament\Resources\Organization\Policies\Pages\EditPolicy;
use App\Filament\Resources\Organization\Policies\Pages\ListPolicies;
use App\Filament\Resources\Organization\Policies\Pages\ViewPolicy;
use App\Filament\Resources\Organization\Policies\Schemas\PolicyForm;
use App\Filament\Resources\Organization\Policies\Schemas\PolicyInfolist;
use App\Filament\Resources\Organization\Policies\Tables\PoliciesTable;
use App\Models\Organization\Policy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PolicyResource extends Resource
{
    protected static ?string $model = Policy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Organization';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PolicyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PolicyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PoliciesTable::configure($table);
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
            'index' => ListPolicies::route('/'),
            'create' => CreatePolicy::route('/create'),
            'view' => ViewPolicy::route('/{record}'),
            'edit' => EditPolicy::route('/{record}/edit'),
        ];
    }
}
