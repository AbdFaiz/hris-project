<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Pages;

use App\Filament\Resources\Recruitment\FpsRequests\FpsRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFpsRequests extends ListRecords
{
    protected static string $resource = FpsRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
