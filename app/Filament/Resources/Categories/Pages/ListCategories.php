<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Buat Category')
                ->modalHeading('Buat Kategori Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('md')
                ->form([
                    TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required()
                        ->maxLength(255),
                    
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->nullable(),
                ]),
        ];
    }
}
