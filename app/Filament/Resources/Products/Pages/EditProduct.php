<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use App\Models\Category;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
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
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4),
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
                    ->directory('products'),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
                Toggle::make('is_popular')
                    ->label('Populer')
                    ->default(false),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
