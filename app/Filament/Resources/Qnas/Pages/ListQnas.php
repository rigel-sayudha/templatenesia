<?php

namespace App\Filament\Resources\Qnas\Pages;

use App\Filament\Resources\Qnas\QnaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQnas extends ListRecords
{
    protected static string $resource = QnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
