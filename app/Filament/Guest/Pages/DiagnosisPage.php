<?php

namespace App\Filament\Guest\Pages;

use App\Filament\Guest\Resources\ResultResource;
use App\Models\Symptom;
use App\Services\DiagnosisService;
use DragonCode\Support\Facades\Helpers\Str;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Builder;

class DiagnosisPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.guest.pages.diagnosis-page';

    protected static ?string $title = 'Diagnosa';

    protected static ?string $navigationGroup = 'Diagnosa';

    protected static ?int $navigationSort = 1;

    public array $data;

    public function mount()
    {
        $this->data = [
            'code' => Str::random(10),
            'date' => now()->toDateTimeLocalString(),
            'notes' => null,
            'symptoms' => [],
            'diagnoses' => [],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make()
                            ->schema([
                                DateTimePicker::make('date')
                                    ->translateLabel()
                                    ->required(),
                                TextInput::make('code')
                                    ->translateLabel()
                                    ->readOnly(),
                                Textarea::make('notes')
                                    ->translateLabel()
                                    ->nullable()
                                    ->columnSpan(['lg' => 2, 'default' => 1]),
                            ]),
                        Repeater::make('diagnoses')
                            ->minItems(1)
                            ->defaultItems(1)
                            ->orderColumn(false)
                            ->schema([
                                Select::make('symptom_id')
                                    ->required()
                                    ->options(fn ($state) => $this->getSymptomBaseQuery($state)->pluck('name', 'id'))
                                    ->searchable()
                                    ->getSearchResultsUsing(
                                        fn ($state, $search) => $this
                                        ->getSymptomBaseQuery($state)
                                        ->when($search, fn ($query) => $query->where('name', 'like', "%$search%"))
                                        ->pluck('name', 'id')
                                    )
                                    ->columnSpan(['lg' => 2, 'default' => 1]),
                                Select::make('rule')
                                    ->required()
                                    ->options(DiagnosisService::getRuleOptions())
                                    ->columnSpan(['lg' => 1, 'default' => 1]),
                            ])
                            ->columns(['lg' => 3, 'default' => 1]),
                    ]),
                Actions::make([
                    Actions\Action::make('submit')
                        ->label('Mulai Diagnosa')
                        ->action('submit'),
                ]),
            ]);
    }

    public function getSymptomBaseQuery($state = null): Builder
    {
        $selected = [];

        foreach ($this->data['diagnoses'] as $diagnosis) {
            if (blank($diagnosis['symptom_id'] ?? null)) {
                continue;
            }

            if ($state && $state == $diagnosis['symptom_id']) {
                continue;
            }

            $selected[] = $diagnosis['symptom_id'];
        }

        return Symptom::query()
            ->whereNotIn('id', $selected)
            ->orderBy('id');
    }

    public function submit()
    {
        $data = $this->form->getState();

        try {
            $result = (new DiagnosisService())->diagnose($data);

            redirect(ResultResource::getUrl('view', ['record' => $result]));
        } catch (\Exception $exception) {
            Notification::make()
                ->title($exception->getMessage())
                ->danger()
                ->send();
        }
    }
}
