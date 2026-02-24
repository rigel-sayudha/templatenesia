<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use Filament\Actions\CreateAction;
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
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(CategoryForm::schema()),
        ];
    }
}
