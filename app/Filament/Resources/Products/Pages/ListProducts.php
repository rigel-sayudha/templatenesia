<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Category;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Products\Schemas\ProductForm;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Product')
                ->modalHeading('Tambah Product Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(ProductForm::schema()),
        ];
    }
}
