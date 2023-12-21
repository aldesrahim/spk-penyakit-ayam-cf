<?php

namespace App\Services;

use App\Models\KnowledgeBase;
use App\Models\Result;
use App\Models\ResultDiagnosis;
use App\Models\ResultDisease;
use App\Models\ResultSymptom;
use Illuminate\Support\Facades\DB;

class DiagnosisService
{
    public static function getRuleOptions(): array
    {
        return [
            '1' => 'Pasti ya (1)',
            '0.8' => 'Hampir pasti ya (0.8)',
            '0.6' => 'Kemungkinan besar ya (0.6)',
            '0.4' => 'Mungkin ya (0.4)',
            '-0.2' => 'Tidak tahu (-0.2)',
            '-0.4' => 'Mungkin tidak (-0.4)',
            '-0.6' => 'Kemungkinan besar tidak (-0.6)',
            '-0.8' => 'Hampir pasti tidak (-0.8)',
            '-1' => 'Pasti tidak (-1)',
        ];
    }

    public function diagnose(array $data)
    {
        $cfGroup = [];
        $cfcGroup = []; // CF Combination
        $cfGroupResult = [];
        $cfRule = [];
        $symptomIds = [];

        foreach ($data['diagnoses'] as $diagnosis) {
            $symptomIds[] = $diagnosis['symptom_id'];
            $cfRule[$diagnosis['symptom_id']] = $diagnosis['rule'];
        }

        $knowledgeBases = KnowledgeBase::query()
            ->with(['symptom', 'disease'])
            ->whereIn('symptom_id', $symptomIds)
            ->orderBy('disease_id')
            ->orderBy('symptom_id')
            ->get();

        foreach ($knowledgeBases as $knowledgeBase) {
            $diseaseId = $knowledgeBase->disease_id;
            $symptomId = $knowledgeBase->symptom_id;
            $mb = $knowledgeBase->mb;
            $md = $knowledgeBase->md;

            $cfGroup[$diseaseId] ??= [];

            $currentCf = $mb - $md; // RUMUS1 CF[H, E] = MB[H, E] - MD[H, E]
            $currentCf *= $cfRule[$symptomId]; // RUMUS2 CF[H, E] = CF[E] * CF[Rule]
            $cfGroup[$diseaseId][] = ['value' => $currentCf, 'symptom_id' => $symptomId];
            $cfGroupResult[$diseaseId] = $currentCf;

            $cfGroupCount = count($cfGroup[$diseaseId]);
            if ($cfGroupCount === 1) {
                continue;
            }

            // HITUNG KOMBINASI

            $cfcGroup[$diseaseId] ??= [];

            $cfcGroupCount = count($cfcGroup[$diseaseId]);

            $prevCf = $cfcGroupCount === 0
                ? $cfGroup[$diseaseId][$cfGroupCount - 2]['value']
                : $cfcGroup[$diseaseId][$cfcGroupCount - 1];

            /**
             * Teori: https://www.teamtrainit.com/demo/algoritma/cf/teori.php
             *
             * (1) CF[H, E] = CF[lama] + (CF[baru] * (1 - CF[lama]))
             * (2) CF[H, E] = CF[lama] + (CF[baru] * (1 + CF[lama]))
             * (3) CF[H, E] = (CF[lama] + CF[baru]) / (1 - min(CF[lama] | CF[baru]))
             *
             * Note:
             * Rule (3) sudah mengikuti rumus yang benar dan berbeda dengan yg ada
             * website referensi teori di atas.
             */
            $currentCfc = match (true) {
                $currentCf > 0 && $prevCf > 0 => $prevCf + ($currentCf * (1 - $prevCf)),
                $currentCf < 0 && $prevCf < 0 => $prevCf + ($currentCf * (1 + $prevCf)),
                default => ($prevCf + $currentCf) / (1 - min($prevCf, $currentCf)),
            };

            $cfcGroup[$diseaseId][] = $currentCfc;
            $cfGroupResult[$diseaseId] = $currentCfc;
        }

        arsort($cfGroupResult, SORT_NUMERIC);

        try {
            DB::beginTransaction();

            $result = Result::create($data);

            $resultDiagnoses = [];
            $resultDiseases = [];
            $sequence = 1;

            foreach ($cfGroupResult as $diseaseId => $diagnosis) {
                $cf = $cfGroup[$diseaseId];
                $cfc = $cfcGroup[$diseaseId] ?? [];

                if ($diagnosis > 0) {
                    $resultDiagnoses[] = [
                        'result_id' => $result->id,
                        'disease_id' => $diseaseId,
                        'certainty_factor' => $diagnosis,
                        'sequence' => $sequence,
                        'created_at' => now(),
                    ];
                }

                $innerSequence = 1;
                foreach ($cf as $cfAttribute) {
                    $resultDiseases[] = [
                        'result_id' => $result->id,
                        'disease_id' => $diseaseId,
                        'symptom_id' => $cfAttribute['symptom_id'],
                        'certainty_factor' => $cfAttribute['value'],
                        'sequence' => $innerSequence++,
                        'created_at' => now(),
                    ];
                }

                foreach ($cfc as $cfcValue) {
                    $resultDiseases[] = [
                        'result_id' => $result->id,
                        'disease_id' => $diseaseId,
                        'symptom_id' => null,
                        'certainty_factor' => $cfcValue,
                        'sequence' => $innerSequence++,
                        'created_at' => now(),
                    ];
                }

                $sequence++;
            }

            $resultSymptoms = array_reduce($data['diagnoses'], function ($carry, $item) use ($result) {
                $carry[] = [
                    'result_id' => $result->id,
                    'symptom_id' => $item['symptom_id'],
                    'rule' => $item['rule'],
                    'created_at' => now()
                ];

                return $carry;
            }, []);

            throw_if(blank($resultDiagnoses), 'Tidak dapat melakukan diagnosa, kemungkinan besar ayam sehat, atau tambahkan gejala lain.');

            ResultDiagnosis::insert($resultDiagnoses);
            ResultDisease::insert($resultDiseases);
            ResultSymptom::insert($resultSymptoms);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        return $result;
    }
}
