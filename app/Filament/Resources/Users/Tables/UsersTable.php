<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Table;
use App\Filament\Resources\Users\Schemas\UserForm;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email_verified_at')
                    ->label('Verifikasi Email')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('verified')
                    ->label('Terverifikasi')
                    ->query(fn (Builder $query) => $query->whereNotNull('email_verified_at'))
                    ->toggle(),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Ubah')
                    ->modalHeading('Ubah User')
                    ->modalWidth('4xl')
                    ->modalFooterActions(fn (): array => [])
                    ->form(UserForm::schema()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
