<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Pages;

use App\Filament\Resources\Recruitment\FpsRequests\FpsRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFpsRequest extends ViewRecord
{
    protected static string $resource = FpsRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
