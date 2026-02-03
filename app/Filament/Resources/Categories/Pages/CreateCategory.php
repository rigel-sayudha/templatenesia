<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Schema;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),
                
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->nullable(),
            ]);
    }
}
