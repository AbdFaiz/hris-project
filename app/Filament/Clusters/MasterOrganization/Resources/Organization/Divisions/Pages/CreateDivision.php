<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\DivisionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDivision extends CreateRecord
{
    protected static string $resource = DivisionResource::class;
}
