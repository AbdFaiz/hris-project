<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('employee_id'),
                TextEntry::make('name'),
                TextEntry::make('company.name')
                    ->numeric(),
                TextEntry::make('region.name')
                    ->numeric(),
                TextEntry::make('division.name')
                    ->numeric(),
                TextEntry::make('unit.name')
                    ->numeric(),
                TextEntry::make('position.name')
                    ->numeric(),
                TextEntry::make('echelon.name')
                    ->numeric(),
                TextEntry::make('grade.name')
                    ->numeric(),
                TextEntry::make('join_date')
                    ->date(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
