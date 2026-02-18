<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Regions\RegionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditRegion extends EditRecord
{
    protected static string $resource = RegionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
