<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Product')
                ->modalHeading('Tambah Product Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    Select::make('category_id')
                        ->label('Kategori')
                        ->options(Category::pluck('name', 'id'))
                        ->required()
                        ->searchable()
                        ->preload(),
                    TextInput::make('name')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3),
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
                    FileUpload::make('image')
                        ->label('Gambar Produk')
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->previewable(true),
                    Toggle::make('is_active')
                        ->label('Produk Aktif')
                        ->default(true),
                    Toggle::make('is_popular')
                        ->label('Populer')
                        ->default(false),
                ]),
        ];
    }
}
