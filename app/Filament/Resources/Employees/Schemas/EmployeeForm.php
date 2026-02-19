<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('employee_id')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('company_id')
                    ->required()
                    ->numeric(),
                TextInput::make('region_id')
                    ->required()
                    ->numeric(),
                TextInput::make('division_id')
                    ->required()
                    ->numeric(),
                TextInput::make('unit_id')
                    ->required()
                    ->numeric(),
                TextInput::make('position_id')
                    ->required()
                    ->numeric(),
                TextInput::make('echelon_id')
                    ->required()
                    ->numeric(),
                TextInput::make('grade_id')
                    ->required()
                    ->numeric(),
                DatePicker::make('join_date')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
