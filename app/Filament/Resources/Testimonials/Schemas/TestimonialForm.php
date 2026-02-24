<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;

class TestimonialForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Informasi Profil')
                    ->description('Nama, foto, dan posisi klien')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Posisi / Jabatan')
                            ->maxLength(255),
                        FileUpload::make('image')
                            ->label('Foto / Avatar')
                            ->image()
                            ->directory('testimonials')
                            ->columnSpanFull(),
                    ])->columns(2),
                Wizard\Step::make('Ulasan & Rating')
                    ->description('Teks ulasan dan penilaian bintang')
                    ->icon('heroicon-o-star')
                    ->schema([
                        TextInput::make('rating')
                            ->label('Rating (1-5)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->default(5)
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('text')
                            ->label('Teks Testimonial')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
            ])
            ->submitAction(new HtmlString('<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);">Simpan</button>'))
            ->columnSpanFull()
        ];
    }
}
