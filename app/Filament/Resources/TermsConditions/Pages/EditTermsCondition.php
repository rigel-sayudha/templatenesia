<?php

namespace App\Filament\Resources\TermsConditions\Pages;

use App\Filament\Resources\TermsConditions\TermsConditionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTermsCondition extends EditRecord
{
    protected static string $resource = TermsConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
