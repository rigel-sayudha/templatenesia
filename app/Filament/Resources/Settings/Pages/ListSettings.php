<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    TextInput::make('key')
                        ->label('Kunci Pengaturan')
                        ->required()
                        ->unique('settings', 'key')
                        ->maxLength(255),
                    Textarea::make('value')
                        ->label('Nilai')
                        ->rows(4),
                ]),
        ];
    }
}
