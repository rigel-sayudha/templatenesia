<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;

class OrderForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Data Produk')
                    ->description('Produk, jumlah, dan total harga')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->default(1),
                        TextInput::make('total')
                            ->label('Total Harga')
                            ->numeric()
                            ->required()
                            ->default(0),
                        Select::make('status')
                            ->label('Status Pesanan')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->default('pending')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),
                Wizard\Step::make('Data Pelanggan')
                    ->description('Informasi pembeli / customer')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('customer_phone')
                            ->label('Telepon Pelanggan')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('customer_email')
                            ->label('Email Pelanggan')
                            ->email()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])->columns(2),
            ])
            ->submitAction(new HtmlString('<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);">Simpan</button>'))
            ->columnSpanFull()
        ];
    }
}
