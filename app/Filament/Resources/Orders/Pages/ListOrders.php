<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Orders\Schemas\OrderForm;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Order')
                ->modalHeading('Tambah Order Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(OrderForm::schema()),
        ];
    }
}
