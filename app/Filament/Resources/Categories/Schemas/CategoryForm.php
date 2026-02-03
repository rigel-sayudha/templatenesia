<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: E-book, Template, SOP'),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Deskripsi kategori produk')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
