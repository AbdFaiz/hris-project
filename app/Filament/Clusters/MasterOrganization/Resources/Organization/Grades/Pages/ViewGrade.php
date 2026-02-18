<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\Grades\GradeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGrade extends ViewRecord
{
    protected static string $resource = GradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
