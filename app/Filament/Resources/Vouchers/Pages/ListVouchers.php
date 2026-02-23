<?php

namespace App\Filament\Resources\Vouchers\Pages;

use App\Filament\Resources\Vouchers\VoucherResource;
use Filament\Actions\CreateAction;
use App\Filament\Resources\Vouchers\Schemas\VoucherForm;
use Filament\Resources\Pages\ListRecords;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Voucher')
                ->modalHeading('Tambah Voucher Baru')
                ->modalFooterActions(fn (): array => [])
                ->modalWidth('4xl')
                ->form(VoucherForm::schema()),
        ];
    }
}
