<?php

namespace App\Filament\Resources\Qnas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use App\Filament\Resources\Qnas\Schemas\QnaForm;

class QnasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('answer')
                    ->label('Jawaban')
                    ->limit(50),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
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
                    ->modalHeading('Ubah Q&A')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(QnaForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
