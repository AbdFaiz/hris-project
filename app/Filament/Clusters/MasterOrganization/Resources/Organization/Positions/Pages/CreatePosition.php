<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Positions\PositionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePosition extends CreateRecord
{
    protected static string $resource = PositionResource::class;
}
