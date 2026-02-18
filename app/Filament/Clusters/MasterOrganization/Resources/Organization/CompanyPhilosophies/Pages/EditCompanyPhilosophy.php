<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Pages;

use App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\CompanyPhilosophyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyPhilosophy extends EditRecord
{
    protected static string $resource = CompanyPhilosophyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
