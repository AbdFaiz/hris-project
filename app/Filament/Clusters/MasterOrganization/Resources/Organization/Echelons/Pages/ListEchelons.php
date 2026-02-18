<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\EchelonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEchelons extends ListRecords
{
    protected static string $resource = EchelonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
