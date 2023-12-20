<?php

namespace App\Filament\Guest\Resources\ResultResource\Pages;

use App\Filament\Guest\Resources\ResultResource;
use App\Models\KnowledgeBase;
use App\Models\Result;
use Filament\Resources\Pages\ViewRecord;

class ViewResult extends ViewRecord
{
    protected static string $resource = ResultResource::class;

    public function mount(int|string $record): void
    {
        parent::mount($record);

        $this->getRecord()
            ->loadMissing([
                'diagnoses',
                'diseases',
                'symptoms',
                'diagnosis',
                'diagnosis.disease',
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** @var Result $record */
        $record = $this->getRecord();

        $data['symptoms'] = $record->symptoms->pluck('id');
        $data['has_other_diagnoses'] = $record->diagnoses()
            ->where('sequence', '>', 1)
            ->orderBy('sequence')
            ->exists();

        $data['knowledge_bases'] = [];

        $knowledgeBases = KnowledgeBase::query()
            ->with(['symptom', 'disease'])
            ->whereIn('symptom_id', $data['symptoms'])
            ->orderBy('symptom_id')
            ->orderBy('disease_id')
            ->get();

        foreach ($knowledgeBases as $knowledgeBase) {
            $data['knowledge_bases'][] = [
                'symptom' => $knowledgeBase->symptom->name,
                'disease' => $knowledgeBase->disease->name,
                'mb' => $knowledgeBase->mb,
                'md' => $knowledgeBase->md,
            ];
        }

        return $data;
    }
}
