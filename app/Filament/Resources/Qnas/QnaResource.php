<?php

namespace App\Filament\Resources\Qnas;

use App\Filament\Resources\Qnas\Pages\CreateQna;
use App\Filament\Resources\Qnas\Pages\EditQna;
use App\Filament\Resources\Qnas\Pages\ListQnas;
use App\Filament\Resources\Qnas\Schemas\QnaForm;
use App\Filament\Resources\Qnas\Tables\QnasTable;
use App\Models\Qna;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QnaResource extends Resource
{
    protected static ?string $model = Qna::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getNavigationGroup(): ?string
    {
        return 'Management Website';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public static function form(Schema $schema): Schema
    {
        return QnaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QnasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQnas::route('/'),
        ];
    }
}
