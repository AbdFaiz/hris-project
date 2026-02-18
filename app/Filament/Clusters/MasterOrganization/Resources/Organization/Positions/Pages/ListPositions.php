<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\PositionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPositions extends ListRecords
{
    protected static string $resource = PositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
