<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages\CreateCompanyPhilosophy;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages\EditCompanyPhilosophy;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages\ListCompanyPhilosophies;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages\ViewCompanyPhilosophy;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Schemas\CompanyPhilosophyForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Schemas\CompanyPhilosophyInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Tables\CompanyPhilosophiesTable;
use App\Models\Organization\CompanyPhilosophy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyPhilosophyResource extends Resource
{
    protected static ?string $model = CompanyPhilosophy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    public static function form(Schema $schema): Schema
    {
        return CompanyPhilosophyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyPhilosophyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyPhilosophiesTable::configure($table);
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
            'index' => ListCompanyPhilosophies::route('/'),
            'create' => CreateCompanyPhilosophy::route('/create'),
            'view' => ViewCompanyPhilosophy::route('/{record}'),
            'edit' => EditCompanyPhilosophy::route('/{record}/edit'),
        ];
    }
}
