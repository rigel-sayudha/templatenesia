<?php

namespace App\Filament\Resources\Qnas\Pages;

use App\Filament\Resources\Qnas\QnaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQna extends EditRecord
{
    protected static string $resource = QnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
