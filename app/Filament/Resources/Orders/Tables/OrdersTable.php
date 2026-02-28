<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\Orders\Schemas\OrderForm;

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
                TextColumn::make('meta.method')
                    ->label('Metode Pembayaran')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? ucfirst($state) : '-')
                    ->color('info'),
                ImageColumn::make('payment_proof')
                    ->label('Resi')
                    ->circular()
                    ->disk('public')
                    ->action(
                        Action::make('view_resi')
                            ->modalHeading('Bukti Pembayaran')
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                            ->infolist([
                                ImageEntry::make('payment_proof')
                                    ->hiddenLabel()
                                    ->disk('public')
                                    ->extraImgAttributes(['style' => 'width: 100%; max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #e2e8f0;'])
                            ])
                    ),
            ])
            ->filters([
                SelectFilter::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Produk'),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Sukses',
                        'failed' => 'Gagal',
                        'cancelled' => 'Dibatalkan',
                    ]),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah Order')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(OrderForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
