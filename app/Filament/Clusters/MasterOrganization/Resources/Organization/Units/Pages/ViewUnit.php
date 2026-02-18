<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\UnitResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUnit extends ViewRecord
{
    protected static string $resource = UnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
