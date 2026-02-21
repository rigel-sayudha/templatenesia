<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Order')
                ->modalHeading('Tambah Order Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    Select::make('product_id')
                        ->label('Produk')
                        ->relationship('product', 'name'),
                    TextInput::make('quantity')
                        ->label('Jumlah')
                        ->numeric()
                        ->default(1),
                    TextInput::make('total')
                        ->label('Total')
                        ->numeric()
                        ->default(0),
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending' => 'Pending',
                            'processing' => 'Diproses',
                            'shipped' => 'Dikirim',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ])
                        ->default('pending'),
                    TextInput::make('customer_name')
                        ->label('Nama Pelanggan')
                        ->maxLength(255),
                    TextInput::make('customer_phone')
                        ->label('Telepon Pelanggan')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('customer_email')
                        ->label('Email Pelanggan')
                        ->email()
                        ->maxLength(255),
                ]),
        ];
    }
}
