<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CompanyPhilosophyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                Textarea::make('vision')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('vision_media'),
                Textarea::make('mission')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('mission_media'),
                TextInput::make('updated_by')
                    ->numeric(),
            ]);
    }
}
