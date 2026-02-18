<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\CompanyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
