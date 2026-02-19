<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages\CreateCompany;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages\EditCompany;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages\ListCompanies;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages\ViewCompany;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Schemas\CompanyForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Schemas\CompanyInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Tables\CompaniesTable;
use App\Models\Organization\Company;
use BackedEnum;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyResource extends Resource
// implements HasShieldPermissions
{
    protected static ?string $model = Company::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationLabel(): string
{
    return __('Company'); // Dia bakal nyari kunci "Company" di id.json
}

public static function getModelLabel(): string
{
    return __('Company');
}

public static function getPluralModelLabel(): string
{
    return __('Companies');
}

    // public static function getPermissionPrefixes(): array
    // {
    //     return [
    //         'view',
    //         'view_any',
    //         'create',
    //         'update',
    //         'delete',
    //         'delete_any',
    //     ];
    // }

    public static function form(Schema $schema): Schema
    {
        return CompanyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
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
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'view' => ViewCompany::route('/{record}'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}
