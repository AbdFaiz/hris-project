<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Tables;

use App\Models\Recruitment\FpsRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FpsRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fps_number')
                    ->searchable(),
                TextColumn::make('applicant_name')
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
                Action::make('exportPdf')
                    ->label('Export PDF (FPS)')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->action(function (FpsRequest $record) {
                        $pdf = Pdf::loadView('pdf.fps-request', ['record' => $record])
                            ->setPaper('a4', 'portrait');

                        $filename = 'FPS-' . Str::slug($record->fps_number, '-') . '.pdf';

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, $filename);
                    }),
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
