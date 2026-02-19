<?php

namespace App\Filament\Resources\Organization\Policies\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PolicyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('policy_number')
                ->label('No Policy')
                ->placeholder('Contoh: No. 000/SE/DIR-HCM/ACS/2025')
                ->required()
                ->maxLength(255),

            TextInput::make('name')
                ->label('Policy Name')
                ->required(),

            DatePicker::make('effective_date')
                ->label('Effective Date')
                ->displayFormat('d/m/Y') // Format dd/mm/yyyy sesuai permintaan
                ->required(),

            Textarea::make('description')
                ->rows(3),

            FileUpload::make('file_path')
                ->label('Upload File PDF/Image')
                ->directory('company-policies')
                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg', 'image/jpg'])
                ->maxSize(5120)
                ->preserveFilenames()
                ->openable()
                ->downloadable()
                ->required(),
        ])
        ->columns(1);
    }
}
