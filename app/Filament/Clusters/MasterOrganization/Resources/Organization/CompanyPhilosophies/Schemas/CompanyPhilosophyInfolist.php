<?php

namespace App\Filament\Clusters\MasterOrganization\Resources\Organization\CompanyPhilosophies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CompanyPhilosophyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('company.name')
                    ->label('Company'),
                TextEntry::make('vision')
                    ->columnSpanFull(),
                TextEntry::make('vision_media')
                    ->placeholder('-'),
                TextEntry::make('mission')
                    ->columnSpanFull(),
                TextEntry::make('mission_media')
                    ->placeholder('-'),
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
