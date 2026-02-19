<?php

namespace App\Filament\Resources\Organization\Policies\Pages;

use App\Filament\Resources\Organization\Policies\PolicyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPolicy extends ViewRecord
{
    protected static string $resource = PolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
