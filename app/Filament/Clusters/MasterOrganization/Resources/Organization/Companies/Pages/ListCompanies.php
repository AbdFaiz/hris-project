<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\CompanyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
