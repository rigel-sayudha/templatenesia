<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('customer_name')
                    ->helperText('Isi jika user tidak login'),
                \Filament\Forms\Components\Select::make('rating')
                    ->options([
                        5 => '5 - Sangat Puas',
                        4 => '4 - Puas',
                        3 => '3 - Cukup',
                        2 => '2 - Buruk',
                        1 => '1 - Sangat Buruk',
                    ])
                    ->required()
                    ->default(5),
                Textarea::make('comment')
                    ->columnSpanFull(),
                Toggle::make('is_visible')
                    ->label('Tampilkan di Frontend')
                    ->default(true),
            ]);
    }
}
