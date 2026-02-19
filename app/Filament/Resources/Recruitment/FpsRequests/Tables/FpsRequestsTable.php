<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FpsRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fps_number')
                    ->searchable(),
                TextColumn::make('applicant.name')
                    ->searchable(),
                TextColumn::make('applicant_name')
                    ->searchable(),
                TextColumn::make('applicant_position')
                    ->searchable(),
                TextColumn::make('applicant_region')
                    ->searchable(),
                TextColumn::make('request_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('needed_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('request_type')
                    ->badge(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('final_status')
                    ->badge(),
                TextColumn::make('closed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
