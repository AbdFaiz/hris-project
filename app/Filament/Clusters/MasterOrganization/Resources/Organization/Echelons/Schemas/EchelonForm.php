<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Echelons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EchelonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('echelon_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('profile')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('updated_by')
                    ->numeric(),
            ]);
    }
}
