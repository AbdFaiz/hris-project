<?php

namespace App\Filament\Resources\Organization\Policies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PolicyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('policy_number'),
                TextEntry::make('name'),
                TextEntry::make('effective_date')
                    ->date(),
                TextEntry::make('profile')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('file_path'),
                TextEntry::make('updated_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
