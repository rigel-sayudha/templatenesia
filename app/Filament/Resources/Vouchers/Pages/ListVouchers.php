<?php

namespace App\Filament\Resources\Vouchers\Pages;

use App\Filament\Resources\Vouchers\VoucherResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Voucher')
                ->modalHeading('Tambah Voucher Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    TextInput::make('code')
                        ->label('Kode Voucher')
                        ->required()
                        ->unique('vouchers', 'code')
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
                        ->label('Nilai')
                        ->numeric()
                        ->required(),
                    TextInput::make('usage_limit')
                        ->label('Batas Penggunaan')
                        ->numeric(),
                    DatePicker::make('start_date')
                        ->label('Tanggal Mulai'),
                    DatePicker::make('end_date')
                        ->label('Tanggal Berakhir'),
                    Toggle::make('is_active')
                        ->label('Aktif'),
                ]),
        ];
    }
}
