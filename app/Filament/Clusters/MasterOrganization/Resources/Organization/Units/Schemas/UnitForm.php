<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Select::make('division_id')
                    ->relationship('division', 'name')
                    ->required(),
                TextInput::make('unit_id')
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
