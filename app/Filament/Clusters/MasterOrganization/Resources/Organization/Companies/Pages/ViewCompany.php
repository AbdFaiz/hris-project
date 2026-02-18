<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\CompanyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
