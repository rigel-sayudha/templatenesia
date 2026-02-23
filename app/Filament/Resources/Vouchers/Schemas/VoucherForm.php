<?php

namespace App\Filament\Resources\Vouchers\Schemas;

use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class VoucherForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Step::make('Informasi Dasar')
                    ->description('Kode & persentase pemotongan')
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Voucher')
                            ->required()
                            ->unique('vouchers', 'code', ignoreRecord: true)
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3),
                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'percentage' => 'Persentase (%)',
                                'nominal' => 'Nominal (Rp)',
                            ])
                            ->required()
                            ->default('percentage'),
                        TextInput::make('value')
                            ->label('Nilai Potongan')
                            ->numeric()
                            ->required(),
                    ]),
                    
                Step::make('Batas & Kuota')
                    ->description('Validitas & jadwal')
                    ->icon('heroicon-m-calendar')
                    ->schema([
                        TextInput::make('usage_limit')
                            ->label('Batas Penggunaan Maksimal')
                            ->numeric(),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai Berlaku'),
                        DatePicker::make('end_date')
                            ->label('Tanggal Berakhir'),
                    ]),
                    
                Step::make('Status')
                    ->description('Ketersediaan di platform')
                    ->icon('heroicon-m-check-circle')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif / Tersedia')
                            ->default(true),
                    ]),
            ])
            ->submitAction(new HtmlString('<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);">Simpan</button>'))
            ->columnSpan('full')
        ];
    }
}
