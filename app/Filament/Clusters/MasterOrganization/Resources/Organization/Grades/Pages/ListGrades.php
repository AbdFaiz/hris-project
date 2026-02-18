<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\GradeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGrades extends ListRecords
{
    protected static string $resource = GradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
