<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades;

use App\Filament\Clusters\MasterOrganization\MasterOrganizationCluster;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages\CreateGrade;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages\EditGrade;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages\ListGrades;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages\ViewGrade;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Schemas\GradeForm;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Schemas\GradeInfolist;
use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Tables\GradesTable;
use App\Models\Organization\Grade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GradeResource extends Resource
{
    protected static ?string $model = Grade::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = MasterOrganizationCluster::class;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return GradeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GradeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GradesTable::configure($table);
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
            'index' => ListGrades::route('/'),
            'create' => CreateGrade::route('/create'),
            'view' => ViewGrade::route('/{record}'),
            'edit' => EditGrade::route('/{record}/edit'),
        ];
    }
}
