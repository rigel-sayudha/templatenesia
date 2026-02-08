<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Informasi Dasar')
                        ->description('Nama, kategori, dan deskripsi produk')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Select::make('category_id')
                                ->label('Kategori')
                                ->options(Category::pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->preload(),
                            TextInput::make('name')
                                ->label('Nama Produk')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            Textarea::make('description')
                                ->label('Deskripsi')
                                ->rows(4)
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Harga')
                        ->description('Atur harga normal dan diskon')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            TextInput::make('price')
                                ->label('Harga Normal')
                                ->numeric()
                                ->required()
                                ->prefix('Rp'),
                            TextInput::make('discount_price')
                                ->label('Harga Diskon')
                                ->numeric()
                                ->nullable()
                                ->prefix('Rp'),
                        ]),
                    Wizard\Step::make('Media & Status')
                        ->description('Gambar dan status produk')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Gambar Produk')
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->columnSpanFull(),
                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true),
                            Toggle::make('is_popular')
                                ->label('Populer')
                                ->default(false),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }
}

