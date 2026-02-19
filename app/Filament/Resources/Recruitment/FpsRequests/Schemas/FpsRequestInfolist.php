<?php

namespace App\Filament\Resources\Recruitment\FpsRequests\Schemas;

use App\Models\Recruitment\FpsRequest;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Schema;

class FpsRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                /* =========================
                   SECTION 1: INFORMASI PEMOHON
                ========================== */
                Section::make('Informasi Pengajuan FPS')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('fps_number')
                                ->label('No FPS')
                                ->weight('bold')
                                ->copyable(),
                            TextEntry::make('request_date')
                                ->label('Tanggal Pengajuan')
                                ->date('d F Y'),
                            TextEntry::make('needed_date')
                                ->label('Tanggal Dibutuhkan')
                                ->date('d F Y')
                                ->color('warning'),
                        ]),

                        Grid::make(3)->schema([
                            TextEntry::make('applicant_name')
                                ->label('Nama Pemohon'),
                            TextEntry::make('applicant_position')
                                ->label('Jabatan'),
                            TextEntry::make('applicant_region')
                                ->label('Region/Cabang'),
                        ]),

                        Grid::make(2)->schema([
                            TextEntry::make('request_type')
                                ->label('Tipe Permintaan')
                                ->badge()
                                ->formatStateUsing(fn (string $state): string => match ($state) {
                                    'addition' => 'Penambahan',
                                    'replacement' => 'Penggantian',
                                    default => $state,
                                })
                                ->color(fn (string $state): string => match ($state) {
                                    'addition' => 'success',
                                    'replacement' => 'info',
                                    default => 'gray',
                                }),
                            TextEntry::make('status')
                                ->label('Status Pengajuan')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'draft' => 'gray',
                                    'pending' => 'warning',
                                    'approved' => 'success',
                                    'rejected' => 'danger',
                                    default => 'primary',
                                }),
                        ]),
                    ])->collapsible(),

                /* =========================
                   SECTION 2: DETAIL ITEM (REPEATER)
                ========================== */
                Section::make('Detail Permintaan & Kualifikasi SDM')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                Grid::make(4)->schema([
                                    TextEntry::make('position.name')
                                        ->label('Jabatan yang Dicari')
                                        ->weight('bold'),
                                    TextEntry::make('request_quantity')
                                        ->label('Qty')
                                        ->suffix(' Orang'),
                                    TextEntry::make('employment_status')
                                        ->label('Status Kerja')
                                        ->badge(),
                                    TextEntry::make('report_to')
                                        ->label('Head Name'),
                                ]),

                                Grid::make(4)->schema([
                                    TextEntry::make('gender')
                                        ->label('Gender'),
                                    TextEntry::make('age_range')
                                        ->label('Usia'),
                                    TextEntry::make('education_level')
                                        ->label('Pendidikan'),
                                    TextEntry::make('major')
                                        ->label('Jurusan'),
                                ]),

                                Grid::make(3)->schema([
                                    TextEntry::make('work_requirements')
                                        ->label('Kualifikasi Umum')
                                        ->markdown(),
                                    TextEntry::make('special_skills')
                                        ->label('Keahlian Khusus')
                                        ->markdown(),
                                    TextEntry::make('job_description')
                                        ->label('Ringkasan Jobdesc')
                                        ->markdown(),
                                ]),

                                Section::make('Fasilitas & Perlengkapan')
                                    ->schema([
                                        Grid::make(5)->schema([
                                            IconEntry::make('need_work_desk')
                                                ->label('Meja')
                                                ->boolean(),
                                            IconEntry::make('need_uniform')
                                                ->label('Seragam')
                                                ->boolean(),
                                            IconEntry::make('need_computer_laptop')
                                                ->label('Laptop')
                                                ->boolean(),
                                            IconEntry::make('need_email')
                                                ->label('Email')
                                                ->boolean(),
                                            TextEntry::make('other_needs')
                                                ->label('Lainnya')
                                                ->placeholder('-'),
                                        ]),
                                    ])->compact(),
                            ])
                            ->columns(1),
                    ]),

                /* =========================
                   SECTION 3: ALASAN & CATATAN
                ========================== */
                Section::make('Keterangan Tambahan')
                    ->schema([
                        TextEntry::make('request_reason')
                            ->label('Alasan Permintaan SDM')
                            ->columnSpanFull(),
                        
                        TextEntry::make('result_reason')
                            ->label('Catatan Approval/Reject')
                            ->placeholder('Belum ada catatan.')
                            ->color('danger')
                            ->visible(fn($state) => !empty($state))
                            ->columnSpanFull(),
                    ])->collapsible(),

                // Metadata log (Footer)
                Grid::make(4)->schema([
                    TextEntry::make('created_at')->label('Dibuat pada')->dateTime()->size('xs'),
                    TextEntry::make('updated_at')->label('Update terakhir')->dateTime()->size('xs'),
                ])->inlineLabel(),
            ])
            ->columns(1);
    }
}
