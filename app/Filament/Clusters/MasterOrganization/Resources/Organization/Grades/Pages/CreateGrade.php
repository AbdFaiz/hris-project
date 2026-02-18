<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\GradeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGrade extends CreateRecord
{
    protected static string $resource = GradeResource::class;
}
