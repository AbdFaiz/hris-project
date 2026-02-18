<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\Companies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('level'),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('province')
                    ->required(),
                TextInput::make('post_code')
                    ->required(),
                TextInput::make('phone_number')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('website')
                    ->url(),
                TextInput::make('tin_number'),
                TextInput::make('account_number'),
                TextInput::make('account_name'),
                Textarea::make('profile')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('logo'),
                TextInput::make('updated_by')
                    ->numeric(),
            ]);
    }
}
