<?php

namespace App\Filament\Resources\TermsConditions\Pages;

use App\Filament\Resources\TermsConditions\TermsConditionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ListTermsConditions extends ListRecords
{
    protected static string $resource = TermsConditionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Syarat & Ketentuan')
                ->modalHeading('Tambah Syarat & Ketentuan Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    Textarea::make('content')
                        ->label('Konten')
                        ->required()
                        ->rows(6),
                    Toggle::make('is_active')
                        ->label('Aktif'),
                ]),
        ];
    }
}
