<?php

namespace App\Filament\Resources\Qnas\Pages;

use App\Filament\Resources\Qnas\QnaResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;

class ListQnas extends ListRecords
{
    protected static string $resource = QnaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('+ Tambah Q&A')
                ->modalHeading('Tambah Q&A Baru')
                ->modalSubmitActionLabel('Buat')
                ->modalCancelActionLabel('Batal')
                ->modalWidth('2xl')
                ->form([
                    TextInput::make('question')
                        ->label('Pertanyaan')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('answer')
                        ->label('Jawaban')
                        ->required()
                        ->rows(4),
                    TextInput::make('sort_order')
                        ->label('Urutan Tampil')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Aktif'),
                ]),
        ];
    }
}
