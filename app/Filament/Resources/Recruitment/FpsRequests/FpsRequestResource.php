<?php

namespace App\Filament\Resources\Recruitment\FpsRequests;

use App\Filament\Resources\Recruitment\FpsRequests\Pages\CreateFpsRequest;
use App\Filament\Resources\Recruitment\FpsRequests\Pages\EditFpsRequest;
use App\Filament\Resources\Recruitment\FpsRequests\Pages\ListFpsRequests;
use App\Filament\Resources\Recruitment\FpsRequests\Pages\ViewFpsRequest;
use App\Filament\Resources\Recruitment\FpsRequests\Schemas\FpsRequestForm;
use App\Filament\Resources\Recruitment\FpsRequests\Schemas\FpsRequestInfolist;
use App\Filament\Resources\Recruitment\FpsRequests\Tables\FpsRequestsTable;
use App\Models\Recruitment\FpsRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FpsRequestResource extends Resource
{
    protected static ?string $model = FpsRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'fps_number';

    public static function form(Schema $schema): Schema
    {
        return FpsRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FpsRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FpsRequestsTable::configure($table);
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
            'index' => ListFpsRequests::route('/'),
            'create' => CreateFpsRequest::route('/create'),
            'view' => ViewFpsRequest::route('/{record}'),
            'edit' => EditFpsRequest::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
