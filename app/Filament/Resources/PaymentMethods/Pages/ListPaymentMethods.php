<?php

namespace App\Filament\Resources\PaymentMethods\Pages;

use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;

class ListPaymentMethods extends ListRecords
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Metode')
                ->modalHeading('Tambah Metode Pembayaran Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    TextInput::make('name')
                        ->label('Nama Metode Pembayaran')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3),
                    Select::make('type')
                        ->label('Tipe')
                        ->options([
                            'manual' => 'Manual',
                            'automatic' => 'Otomatis',
                        ])
                        ->default('manual'),
                    TextInput::make('bank_code')
                        ->label('Kode Bank')
                        ->maxLength(255),
                    TextInput::make('account_number')
                        ->label('Nomor Rekening')
                        ->maxLength(255),
                    TextInput::make('account_name')
                        ->label('Nama Pemilik Rekening')
                        ->maxLength(255),
                    TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Aktif'),
                ]),
        ];
    }
}
