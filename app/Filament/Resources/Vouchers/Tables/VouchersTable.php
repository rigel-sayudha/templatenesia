<?php

namespace App\Filament\Resources\Vouchers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Table;

class VouchersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode Voucher')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'percentage' ? 'Persentase' : 'Nominal'),
                TextColumn::make('value')
                    ->label('Nilai')
                    ->sortable(),
                TextColumn::make('usage_count')
                    ->label('Penggunaan')
                    ->sortable(),
                BooleanColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('+ Tambah Voucher')
                    ->modalHeading('Tambah Voucher Baru')
                    ->modalSubmitActionLabel('Buat')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('code')
                            ->label('Kode Voucher')
                            ->required()
                            ->unique('vouchers', 'code')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3),
                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'percentage' => 'Persentase (%)',
                                'nominal' => 'Nominal (Rp)',
                            ])
                            ->required()
                            ->default('percentage'),
                        TextInput::make('value')
                            ->label('Nilai')
                            ->numeric()
                            ->required(),
                        TextInput::make('usage_limit')
                            ->label('Batas Penggunaan')
                            ->numeric(),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai'),
                        DatePicker::make('end_date')
                            ->label('Tanggal Berakhir'),
                        Toggle::make('is_active')
                            ->label('Aktif'),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Voucher')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('code')
                            ->label('Kode Voucher')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3),
                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'percentage' => 'Persentase (%)',
                                'nominal' => 'Nominal (Rp)',
                            ])
                            ->required(),
                        TextInput::make('value')
                            ->label('Nilai')
                            ->numeric()
                            ->required(),
                        TextInput::make('usage_limit')
                            ->label('Batas Penggunaan')
                            ->numeric(),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai'),
                        DatePicker::make('end_date')
                            ->label('Tanggal Berakhir'),
                        Toggle::make('is_active')
                            ->label('Aktif'),
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
