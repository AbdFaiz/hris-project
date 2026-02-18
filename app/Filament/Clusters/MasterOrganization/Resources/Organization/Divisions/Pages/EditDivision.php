<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\DivisionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDivision extends EditRecord
{
    protected static string $resource = DivisionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
