<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiseaseResource\Pages;
use App\Models\Disease;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DiseaseResource extends Resource
{
    protected static ?string $model = Disease::class;

    protected static ?string $navigationIcon = 'heroicon-o-bug-ant';

    protected static ?string $modelLabel = 'Penyakit';

    protected static ?string $navigationGroup = 'Ketentuan';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(191),
                Forms\Components\Textarea::make('description')
                    ->translateLabel()
                    ->maxLength(5000)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('suggestion')
                    ->translateLabel()
                    ->maxLength(5000)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image_path')
                    ->label('Ciri-ciri')
                    ->disk('public')
                    ->directory('diseases-image')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->using(static fn (Disease $record) => $record->knowledgeBases()->doesntExist() && $record->delete())
                    ->failureNotificationTitle('Tidak dapat dihapus karena sudah terikat dengan data lain'),
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
            'index' => Pages\ListDiseases::route('/'),
        ];
    }
}
