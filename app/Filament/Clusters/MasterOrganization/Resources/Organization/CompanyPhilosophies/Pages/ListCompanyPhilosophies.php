<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\CompanyPhilosophyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanyPhilosophies extends ListRecords
{
    protected static string $resource = CompanyPhilosophyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
