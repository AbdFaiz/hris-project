<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Divisions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DivisionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('division_id')
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
