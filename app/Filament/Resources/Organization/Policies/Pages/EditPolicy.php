<?php

namespace App\Filament\Resources\Organization\Policies\Pages;

use App\Filament\Resources\Organization\Policies\PolicyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPolicy extends EditRecord
{
    protected static string $resource = PolicyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
