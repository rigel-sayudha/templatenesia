<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Filament\Resources\Users\Schemas\UserForm;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah User')
                ->modalHeading('Tambah User Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(UserForm::schema()),
        ];
    }
}
