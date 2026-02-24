<?php

namespace App\Filament\Resources\TermsConditions\Pages;

use App\Filament\Resources\TermsConditions\TermsConditionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TermsConditions\Schemas\TermsConditionForm;

class ListTermsConditions extends ListRecords
{
    protected static string $resource = TermsConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Syarat & Ketentuan')
                ->modalHeading('Tambah Syarat & Ketentuan Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(TermsConditionForm::schema()),
        ];
    }
}
