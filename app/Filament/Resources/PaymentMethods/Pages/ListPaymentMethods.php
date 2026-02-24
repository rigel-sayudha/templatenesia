<?php

namespace App\Filament\Resources\PaymentMethods\Pages;

use App\Filament\Resources\PaymentMethods\PaymentMethodResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PaymentMethods\Schemas\PaymentMethodForm;

class ListPaymentMethods extends ListRecords
{
    protected static string $resource = PaymentMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Metode')
                ->modalHeading('Tambah Metode Pembayaran Baru')
                ->modalWidth('4xl')
                ->modalFooterActions(fn (): array => [])
                ->form(PaymentMethodForm::schema()),
        ];
    }
}
