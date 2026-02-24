<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use App\Filament\Resources\Categories\Schemas\CategoryForm;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable()
                    ->size('lg')
                    ->weight('bold'),

                TextColumn::make('products_count')
                    ->label('Jumlah Produk')
                    ->counts('products')
                    ->alignment('center')
                    ->badge()
                    ->color('info'),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        return $column->getState();
                    })
                    ->color('gray'),
            ])
            ->filters([
                Filter::make('has_products')
                    ->label('Memiliki Produk')
                    ->query(fn (Builder $query) => $query->whereHas('products'))
                    ->toggle(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Edit Kategori')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(CategoryForm::schema()),

                DeleteAction::make()
                    ->label('Hapus')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus Kategori')
                    ->modalDescription('Apakah Anda yakin ingin menghapus kategori ini?')
                    ->modalSubmitActionLabel('Ya, Hapus')
                    ->modalCancelActionLabel('Batal'),
            ])
            ->defaultSort('name')
            ->paginated([10, 25, 50])
            ->striped();
    }
}
