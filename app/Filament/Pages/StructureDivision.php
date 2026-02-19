<?php

namespace App\Filament\Pages;

use App\Models\Organization\Division;
use App\Models\Organization\Position;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class StructureDivision extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;
    protected string $view = 'filament.pages.structure-division';
    public static function getNavigationLabel(): string
{
    return __('Structure Company');
}

public static function getModelLabel(): string
{
    return __('Structure Company');
}

public static function getPluralModelLabel(): string
{
    return __('Structure Companies');
}
    protected static string|UnitEnum|null $navigationGroup = 'Organization';

    public ?array $data = [];
    public $positions = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('division_id')
                    ->label('Choose Division')
                    ->options(Division::pluck('name', 'id'))
                    ->live() // Update otomatis saat dipilih
                    ->afterStateUpdated(fn ($state) => $this->loadStructure($state))
                    ->required(),
            ])
            ->statePath('data');
    }

    public function loadStructure($divisionId)
{
    if (!$divisionId) {
        $this->positions = [];
        return;
    }

    // Ambil posisi, muat unitnya, dan muat employee yang menjabat saat ini
    $this->positions = Position::with(['unit', 'employees'])
        ->where('division_id', $divisionId)
        ->get();
}

    public function exportPdf()
    {
        // Logic Export PDF menggunakan dompdf atau snappy
        // return response()->streamDownload(...)
    }
}
