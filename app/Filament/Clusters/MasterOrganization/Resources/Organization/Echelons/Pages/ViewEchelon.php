<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\EchelonResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEchelon extends ViewRecord
{
    protected static string $resource = EchelonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
