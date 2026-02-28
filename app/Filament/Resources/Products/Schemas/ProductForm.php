<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\HtmlString;

use Filament\Forms\Components\Repeater;

class ProductForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                    Wizard\Step::make('Informasi Dasar')
                        ->description('Nama, kategori, dan deskripsi produk')
                        ->icon('heroicon-o-information-circle')
                        ->schema([
                            Select::make('category_id')
                                ->label('Kategori')
                                ->options(Category::pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->preload(),
                            TextInput::make('name')
                                ->label('Nama Produk')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            Textarea::make('description')
                                ->label('Deskripsi')
                                ->rows(4)
                                ->columnSpanFull(),
                        ]),
                    Wizard\Step::make('Harga')
                        ->description('Atur harga normal dan diskon')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            TextInput::make('price')
                                ->label('Harga Normal')
                                ->numeric()
                                ->required()
                                ->prefix('Rp'),
                            TextInput::make('discount_price')
                                ->label('Harga Diskon')
                                ->numeric()
                                ->nullable()
                                ->prefix('Rp'),
                        ]),
                    Wizard\Step::make('Media & Status')
                        ->description('Gambar dan status produk')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Gambar Produk')
                                ->image()
                                ->disk('public')
                                ->directory('products')
                                ->columnSpanFull(),
                            Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true),
                            Toggle::make('is_popular')
                                ->label('Populer')
                                ->default(false),
                        ]),
                    Wizard\Step::make('Benefits & FAQ')
                        ->description('Keunggulan produk dan pertanyaan umum')
                        ->icon('heroicon-o-list-bullet')
                        ->schema([
                            Repeater::make('benefits')
                                ->label('Apa yang Anda Dapatkan')
                                ->schema([
                                    TextInput::make('text')
                                        ->label('Benefit')
                                        ->required()
                                        ->placeholder('cth: File editable (Word, Excel, PDF)'),
                                ])
                                ->addActionLabel('+ Tambah Benefit')
                                ->defaultItems(0)
                                ->collapsible()
                                ->columnSpanFull(),
                            Repeater::make('faqs')
                                ->label('FAQ (Pertanyaan Umum)')
                                ->schema([
                                    TextInput::make('question')
                                        ->label('Pertanyaan')
                                        ->required()
                                        ->placeholder('cth: Apakah file bisa diedit?'),
                                    Textarea::make('answer')
                                        ->label('Jawaban')
                                        ->required()
                                        ->rows(2)
                                        ->placeholder('cth: Ya, semua file 100% editable.'),
                                ])
                                ->addActionLabel('+ Tambah FAQ')
                                ->defaultItems(0)
                                ->collapsible()
                                ->columnSpanFull(),
                        ]),
                ])
                ->submitAction(new HtmlString('<button type="submit" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 dark:bg-custom-500 dark:hover:bg-custom-400 focus-visible:ring-custom-500/50 dark:focus-visible:ring-custom-400/50" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);">Simpan</button>'))
                ->columnSpan('full')
        ];
    }
}

