<?php

namespace App\Filament\Guest\Resources;

use App\Filament\Guest\Resources\SymptomResource\Pages;
use App\Models\Symptom;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SymptomResource extends Resource
{
    protected static ?string $model = Symptom::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    protected static ?string $modelLabel = 'Gejala';

    protected static ?string $navigationGroup = 'Ketentuan';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
            ]);
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
            'index' => Pages\ListSymptoms::route('/'),
        ];
    }
}
