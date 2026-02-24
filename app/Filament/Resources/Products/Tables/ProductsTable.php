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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;
use App\Filament\Resources\Products\Schemas\ProductForm;

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
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori'),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(ProductForm::schema()),
                DeleteAction::make()
                    ->modalHeading('Delete Product')
                    ->modalDescription('Apakah Anda yakin ingin menghapus produk ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
