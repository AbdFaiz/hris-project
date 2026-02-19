<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Schemas;

use App\Models\Employee;
use App\Models\Organization\Position;
use App\Models\Recruitment\FpsRequest;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class FpsRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        $user = Auth::user();
        $defaultEmployee = Employee::with(['position', 'region'])
            ->where('user_id', $user?->id)
            ->first();

        return $schema->components([

            /* =========================
               SECTION 1
            ========================== */
            Section::make('Create Fps Recruitment')
                ->schema([
                    Grid::make(2)->schema([

                        Grid::make(1)->schema([
                            TextInput::make('fps_number')
                                ->label('No FPS')
                                ->default(FpsRequest::generateFpsNumber())
                                ->disabled()
                                ->dehydrated(true),

                            TextInput::make('applicant_name')
                                ->label('Name')
                                ->default($defaultEmployee?->name)
                                ->disabled()
                                ->dehydrated(true),

                            TextInput::make('applicant_position')
                                ->label('Position')
                                ->default($defaultEmployee?->position?->name ?? '-')
                                ->disabled()
                                ->dehydrated(true),
                        ]),

                        Grid::make(1)->schema([
                            Hidden::make('applicant_id')
                                ->default($defaultEmployee?->id),

                            TextInput::make('applicant_region')
                                ->label('Region')
                                ->default($defaultEmployee?->region?->name ?? '-')
                                ->disabled()
                                ->dehydrated(true),

                            DatePicker::make('request_date')
                                ->label('Date Request')
                                ->default(now())
                                ->disabled()
                                ->dehydrated(true)
                                ->displayFormat('d/m/Y'),
                        ]),
                    ]),

                    Grid::make(2)->schema([
                        DatePicker::make('needed_date')
                            ->label('Date Required')
                            ->required()
                            ->minDate(now())
                            ->displayFormat('d/m/Y'),

                        Select::make('request_type')
                            ->label('Request Type')
                            ->options([
                                'addition' => 'Penambahan',
                                'replacement' => 'Penggantian',
                            ])
                            ->required()
                            ->native(false),
                    ]),
                ]),

            /* =========================
               SECTION 2
            ========================== */
            Section::make('Permintaan dan Kualifikasi SDM')
                ->schema([

                    Repeater::make('items')
                        ->relationship('items')
                        ->schema([

                            Grid::make(2)->schema([
                                TextInput::make('request_quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->default(1)
                                    ->required()
                                    ->minValue(1),

                                Select::make('position_id')
                                    ->label('Position')
                                    ->relationship('position', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->native(false)
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nama Jabatan')
                                            ->required(),
                                    ]),
                            ]),

                            Grid::make(2)->schema([
                                Select::make('gender')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                        'Semua' => 'Laki-laki/Perempuan',
                                    ])
                                    ->default('Semua')
                                    ->native(false),

                                TextInput::make('age_range')
                                    ->label('Age')
                                    ->placeholder('25-35 tahun'),
                            ]),

                            Grid::make(2)->schema([
                                Select::make('education_level')
                                    ->label('Tingkat Pendidikan')
                                    ->options([
                                        'SMA' => 'SMA',
                                        'D3' => 'D3',
                                        'S1' => 'S1',
                                        'S2' => 'S2',
                                        'S3' => 'S3',
                                    ])
                                    ->native(false),

                                TextInput::make('major')
                                    ->label('Jurusan'),
                            ]),

                            Grid::make(2)->schema([
                                Select::make('marital_status')
                                    ->label('Marital Status')
                                    ->options([
                                        'Belum Kawin' => 'Belum Kawin',
                                        'Kawin' => 'Kawin',
                                        'Cerai Hidup' => 'Cerai Hidup',
                                        'Cerai Mati' => 'Cerai Mati',
                                    ])
                                    ->required()
                                    ->native(false),
                                Select::make('report_to')
                                    ->label('Head Name (Lapor Kepada)')
                                    ->options(Employee::all()->pluck('name', 'name')) // Simpan nama langsung ke string
                                    ->searchable()
                                    ->preload()
                                    ->placeholder('Pilih Nama Atasan/User')
                                    ->native(false),
                            ]),

                            Textarea::make('work_requirements')
                                ->label('Qualifications')
                                ->rows(2)
                                ->columnSpanFull(),

                            Textarea::make('special_skills')
                                ->label('Skills')
                                ->rows(2)
                                ->columnSpanFull(),

                            Textarea::make('job_description')
                                ->label('Jobdesc')
                                ->rows(3)
                                ->columnSpanFull(),

                            Select::make('employment_status')
                                ->options([
                                    'intern' => 'Pemagang',
                                    'contract' => 'Kontrak',
                                    'permanent' => 'Tetap',
                                ])
                                ->default('contract')
                                ->columnSpanFull(),

                            Section::make('Kebutuhan Perlengkapan')
                                ->schema([
                                    Grid::make(4)->schema([
                                        Checkbox::make('need_work_desk')->label('Meja Kerja'),
                                        Checkbox::make('need_uniform')->label('Seragam'),
                                        Checkbox::make('need_computer_laptop')->label('Komputer/Laptop'),
                                        Checkbox::make('need_email')->label('Email'),
                                    ]),

                                    TextInput::make('other_needs')
                                        ->label('Lainnya')
                                        ->columnSpanFull(),
                                ])
                                ->compact(),

                            Hidden::make('fulfilled_quantity')->default(0),
                        ])
                        ->defaultItems(0)
                        ->columns(1)
                        ->collapsible()
                        ->cloneable()
                        ->reorderable()
                        ->itemLabel(fn (array $state): ?string => isset($state['position_id'])
                                ? Position::find($state['position_id'])?->name
                                : 'Position Detail'
                        ),
                ]),

            Textarea::make('request_reason')
                ->label('Alasan Permintaan')
                ->required()
                ->rows(3)
                ->columnSpanFull(),
        ])
            ->columns(1);
    }
}
