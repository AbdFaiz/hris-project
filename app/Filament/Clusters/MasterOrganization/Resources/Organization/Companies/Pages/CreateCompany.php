<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\CompanyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;
}
