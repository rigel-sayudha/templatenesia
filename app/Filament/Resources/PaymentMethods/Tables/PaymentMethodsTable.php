<?php

namespace App\Filament\Resources\PaymentMethods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use App\Models\PaymentMethod;

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
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Metode Pembayaran')
                    ->modalSubmitActionLabel('Simpan')
                    ->modalCancelActionLabel('Batal')
                    ->modalWidth('2xl')
                    ->form([
                        TextInput::make('name')
                            ->label('Nama Metode Pembayaran')
                            ->required()
                            ->maxLength(255),
                        FileUpload::make('logo')
                            ->label('Logo Bank/Metode')
                            ->image()
                            ->disk('public')
                            ->directory('payment-method-logos')
                            ->maxSize(2048),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3),
                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'manual' => 'Manual',
                                'automatic' => 'Otomatis',
                            ]),
                        TextInput::make('bank_code')
                            ->label('Kode Bank')
                            ->maxLength(255),
                        TextInput::make('account_number')
                            ->label('Nomor Rekening')
                            ->maxLength(255),
                        TextInput::make('account_name')
                            ->label('Nama Pemilik Rekening')
                            ->maxLength(255),
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric(),
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
