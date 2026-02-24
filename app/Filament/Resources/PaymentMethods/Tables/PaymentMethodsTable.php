<?php

namespace App\Filament\Resources\PaymentMethods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use App\Models\PaymentMethod;
use App\Filament\Resources\PaymentMethods\Schemas\PaymentMethodForm;

class PaymentMethodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(PaymentMethod::query()->where('type', 'manual'))
            ->heading(null)
            ->headerActions([])
            ->columns([
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('public'),
                TextColumn::make('name')
                    ->label('Nama Metode Pembayaran')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->sortable(),
                TextColumn::make('bank_code')
                    ->label('Kode Bank')
                    ->sortable(),
                BooleanColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'manual' => 'Manual Transfer',
                        'automatic' => 'Otomatis',
                        'other' => 'Lainnya',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Metode Pembayaran')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(PaymentMethodForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
