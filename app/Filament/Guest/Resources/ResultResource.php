<?php

namespace App\Filament\Guest\Resources;

use App\Filament\Guest\Resources\ResultResource\Pages;
use App\Models\Result;
use App\Models\ResultDiagnosis;
use App\Services\DiagnosisService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $modelLabel = 'Hasil Diagnosa';

    protected static ?string $navigationGroup = 'Diagnosa';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Diagnosa')
                    ->schema([
                        Forms\Components\Grid::make()
                            ->schema([
                                Forms\Components\DateTimePicker::make('date')
                                    ->translateLabel()
                                    ->required(),
                                Forms\Components\TextInput::make('code')
                                    ->translateLabel()
                                    ->readOnly(),
                                Forms\Components\Textarea::make('notes')
                                    ->translateLabel()
                                    ->nullable()
                                    ->columnSpan(['lg' => 2, 'default' => 1])
                                    ->visible(fn ($record) => filled($record->notes)),
                            ]),
                        Forms\Components\Repeater::make('symptoms')
                            ->relationship('symptoms')
                            ->translateLabel()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Gejala')
                                    ->columnSpan(['lg' => 2, 'default' => 1]),
                                Forms\Components\TextInput::make('rule')
                                    ->translateLabel()
                                    ->formatStateUsing(
                                        fn ($record) => sprintf(
                                            '%s (%s)',
                                            DiagnosisService::getRuleOptions()[$record->pivot->rule + 0],
                                            $record->pivot->rule + 0
                                        )
                                    )
                                    ->columnSpan(['lg' => 1, 'default' => 1]),
                            ])
                            ->columns(['lg' => 3, 'default' => 1]),
                        Forms\Components\Section::make('knowledge_bases')
                            ->heading('Basis Pengetahuan (berdasarkan gejala)')
                            ->collapsible()
                            ->collapsed()
                            ->schema(fn ($state) => static::getKnowledgeBasesSchema($state)),
                        Forms\Components\Section::make('calculations')
                            ->heading('Rumus & Perhitungan CF')
                            ->collapsible()
                            ->collapsed()
                            ->schema([
                                Forms\Components\Placeholder::make('calculation_view')
                                    ->label(false)
                                    ->content(fn ($record) => view('filament.guest.calculation-process', [
                                        'diseases' => $record->diseases()
                                            ->with('disease')
                                            ->orderBy('disease_id')
                                            ->orderBy('sequence')
                                            ->get()
                                            ->groupBy('disease_id')
                                    ]))
                            ]),
                    ]),
                Forms\Components\Section::make('Hasil Diagnosa')
                    ->schema([
                        Forms\Components\Placeholder::make('result')
                            ->label(false)
                            ->content(function ($record) {
                                /** @var ResultDiagnosis $diagnosis */
                                $diagnosis = $record->diagnosis;
                                $cf = $diagnosis->certainty_factor + 0;
                                $percentage = $cf * 100;

                                return new HtmlString(
                                    sprintf(
                                        "Jadi penyakit ayam dengan CF terbesar adalah <b>%s</b> dengan nilai sebesar <b>%s%% (%s)</b>",
                                        $diagnosis->disease->name,
                                        $percentage,
                                        $cf
                                    )
                                );
                            }),
                        Forms\Components\Placeholder::make('diseases')
                            ->label(false)
                            ->content(function ($record) {
                                /** @var ResultDiagnosis $diagnosis */
                                $diagnosis = $record->diagnosis;


                                $html = '<b>Deskripsi penyakit:</b><br>%s<br><br>';
                                $html .= '<b>Saran:</b><br>%s<br><br>';
                                $html .= '<b>Ciri-ciri:</b><br><img src="%s">';

                                return new HtmlString(
                                    sprintf(
                                        $html,
                                        $diagnosis->disease->description,
                                        $diagnosis->disease->suggestion,
                                        Storage::disk('public')->url($diagnosis->disease->image_path),
                                    )
                                );
                            }),
                        Forms\Components\Section::make('has_other_diagnoses')
                            ->heading('Kemungkinan Lain')
                            ->collapsible()
                            ->collapsed()
                            ->visible(fn ($state) => $state['has_other_diagnoses'])
                            ->schema(fn ($record) => static::getOtherDiagnosesSchema($record))
                    ]),

            ]);
    }

    public static function getKnowledgeBasesSchema($data)
    {
        $items = [];
        foreach ($data['knowledge_bases'] as $knowledgeBase) {
            $items[] = Forms\Components\Grid::make('knowledge_base_item')
                ->label(false)
                ->schema([
                    Forms\Components\Placeholder::make('symptom')
                        ->content($knowledgeBase['symptom'])
                        ->translateLabel()
                        ->columnSpan(['lg' => 2, 'default' => 1]),
                    Forms\Components\Placeholder::make('disease')
                        ->content($knowledgeBase['disease'])
                        ->translateLabel()
                        ->columnSpan(['lg' => 2, 'default' => 1]),
                    Forms\Components\Placeholder::make('mb')
                        ->content($knowledgeBase['mb'])
                        ->label('MB')
                        ->columnSpan(['lg' => 1, 'default' => 1]),
                    Forms\Components\Placeholder::make('md')
                        ->content($knowledgeBase['md'])
                        ->label('MD')
                        ->columnSpan(['lg' => 1, 'default' => 1]),
                ])
                ->columns(['lg' => 6, 'default' => 1]);
        }
        return $items;
    }

    public static function getOtherDiagnosesSchema(Result $record)
    {
        $otherDiagnoses = $record->diagnoses()
            ->where('sequence', '>', 1)
            ->orderBy('sequence')
            ->get();

        $items = [];
        foreach ($otherDiagnoses as $diagnosis) {
            $cf = $diagnosis->certainty_factor + 0;
            $percentage = $cf * 100;
            $content = new HtmlString(
                sprintf(
                    "> <b>%s</b> dengan nilai sebesar <b>%s%% (%s)</b>",
                    $diagnosis->disease->name,
                    $percentage,
                    $cf
                )
            );

            $items[] = Forms\Components\Placeholder::make('diseases')
                ->label(false)
                ->content($content);
        }

        return $items;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->translateLabel()
                    ->searchable(),
                Tables\Columns\TextColumn::make('diagnosis.disease.name')
                    ->translateLabel()
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListResults::route('/'),
            'view' => Pages\ViewResult::route('/{record}'),
        ];
    }
}
