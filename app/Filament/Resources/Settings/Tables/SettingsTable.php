<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Resources\Settings\Schemas\SettingForm;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Kunci Pengaturan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Pengaturan')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(SettingForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
