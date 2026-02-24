<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Filament\Resources\Testimonials\Schemas\TestimonialForm;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Posisi')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Gambar'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('rating')
                    ->label('Bintang Rating')
                    ->options([
                        1 => '1 Bintang',
                        2 => '2 Bintang',
                        3 => '3 Bintang',
                        4 => '4 Bintang',
                        5 => '5 Bintang',
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Testimonial')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(TestimonialForm::schema()),
                DeleteAction::make()
                    ->label('Hapus')
                    ->modalHeading('Hapus Testimonial')
                    ->modalDescription('Apakah Anda yakin ingin menghapus testimonial ini?')
                    ->modalSubmitActionLabel('Ya, Hapus'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('+ Tambah Testimonial')
                    ->modalHeading('Tambah Testimonial Baru')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(TestimonialForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
