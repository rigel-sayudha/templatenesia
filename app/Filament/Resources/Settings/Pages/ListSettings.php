<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use App\Filament\Resources\Settings\Schemas\SettingForm;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Pengaturan')
                ->modalHeading('Tambah Pengaturan Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(SettingForm::schema()),
        ];
    }
}
