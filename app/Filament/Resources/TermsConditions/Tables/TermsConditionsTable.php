<?php

namespace App\Filament\Resources\TermsConditions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use App\Filament\Resources\TermsConditions\Schemas\TermsConditionForm;

class TermsConditionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('content')
                    ->label('Konten')
                    ->limit(50),
                BooleanColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Syarat & Ketentuan')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(TermsConditionForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
