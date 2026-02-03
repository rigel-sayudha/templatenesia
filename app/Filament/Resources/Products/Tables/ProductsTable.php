<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->size(80),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->formatStateUsing(fn ($state, $record) => 
                        $state . '<br/><span class="text-xs text-gray-500">' . ($record->category->name ?? '-') . '</span>'
                    )
                    ->html(),
                TextColumn::make('price')
                    ->label('Harga Normal')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),
                TextColumn::make('discount_price')
                    ->label('Harga Diskon')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                ToggleColumn::make('is_popular')
                    ->label('Populer'),
            ])
            ->filters([
                Filter::make('all')
                    ->label('Semua')
                    ->query(fn (Builder $query) => $query)
                    ->default(),
                Filter::make('has_discount')
                    ->label('Diskon')
                    ->query(fn (Builder $query) => $query->whereNotNull('discount_price')->where('discount_price', '<', 'price')),
                Filter::make('is_popular')
                    ->label('Populer')
                    ->query(fn (Builder $query) => $query->where('is_popular', true)),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah product')
                    ->modalSubmitActionLabel('Simpan')
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
                            ->label('Produk Aktif'),
                        Toggle::make('is_popular')
                            ->label('Populer'),
                    ]),
                DeleteAction::make()
                    ->modalHeading('Delete Product')
                    ->modalDescription('Apakah Anda yakin ingin menghapus produk ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->headerActions([
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
