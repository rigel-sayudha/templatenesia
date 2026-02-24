<?php

namespace App\Filament\Resources\Qnas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;

class QnaForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Konten Q&A')
                    ->description('Pertanyaan dan jawaban')
                    ->icon('heroicon-o-question-mark-circle')
                    ->schema([
                        TextInput::make('question')
                            ->label('Pertanyaan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('answer')
                            ->label('Jawaban')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
                Wizard\Step::make('Pengaturan')
                    ->description('Urutan dan status aktif')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ])
            ->submitAction(new HtmlString('<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);">Simpan</button>'))
            ->columnSpanFull()
        ];
    }
}
