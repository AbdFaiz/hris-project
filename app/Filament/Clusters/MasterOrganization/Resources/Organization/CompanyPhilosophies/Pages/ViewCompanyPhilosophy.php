<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\CompanyPhilosophyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyPhilosophy extends ViewRecord
{
    protected static string $resource = CompanyPhilosophyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
