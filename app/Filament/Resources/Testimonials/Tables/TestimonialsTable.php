<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Testimonial')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('text')
                            ->label('Teks Testimonial')
                            ->required()
                            ->rows(4),
                        TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5),
                        TextInput::make('position')
                            ->label('Posisi')
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image(),
                    ]),
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
                    ->modalSubmitActionLabel('Buat')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('text')
                            ->label('Teks Testimonial')
                            ->required()
                            ->rows(4),
                        TextInput::make('rating')
                            ->label('Rating')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->default(5),
                        TextInput::make('position')
                            ->label('Posisi')
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image(),
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
