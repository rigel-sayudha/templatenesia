<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_id')
                    ->label('No. Invoice')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('product.name')
                    ->label('Produk')
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Total')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
                TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('+ Tambah Order')
                    ->modalHeading('Tambah Order Baru')
                    ->modalSubmitActionLabel('Buat')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name'),
                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->default(1),
                        TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->default(0),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ])
                            ->default('pending'),
                        TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->maxLength(255),
                        TextInput::make('customer_phone')
                            ->label('Telepon Pelanggan')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('customer_email')
                            ->label('Email Pelanggan')
                            ->email()
                            ->maxLength(255),
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Order')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        Select::make('product_id')
                            ->label('Produk')
                            ->relationship('product', 'name'),
                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric(),
                        TextInput::make('total')
                            ->label('Total')
                            ->numeric(),
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Diproses',
                                'shipped' => 'Dikirim',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ]),
                        TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->maxLength(255),
                        TextInput::make('customer_phone')
                            ->label('Telepon Pelanggan')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('customer_email')
                            ->label('Email Pelanggan')
                            ->email()
                            ->maxLength(255),
                    ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
