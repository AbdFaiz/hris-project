<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\EchelonResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEchelon extends EditRecord
{
    protected static string $resource = EchelonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
