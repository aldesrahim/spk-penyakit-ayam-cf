<?php

namespace Database\Seeders;

use App\Models\KnowledgeBase;
use Illuminate\Database\Seeder;

class KnowledgeBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $knowledgeBases = [
            ['disease_id' => 1, 'symptom_id' => 12, 'mb' => 0.8, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 1, 'symptom_id' => 23, 'mb' => 0.6, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 1, 'symptom_id' => 24, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 2, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 2, 'symptom_id' => 3, 'mb' => 1.0, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 2, 'symptom_id' => 15, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 2, 'symptom_id' => 21, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 3, 'symptom_id' => 13, 'mb' => 0.6, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 3, 'symptom_id' => 14, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 3, 'symptom_id' => 19, 'mb' => 0.6, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 3, 'symptom_id' => 25, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 2, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 4, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 10, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 11, 'mb' => 0.8, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 4, 'symptom_id' => 20, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 5, 'symptom_id' => 1, 'mb' => 0.6, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 5, 'symptom_id' => 16, 'mb' => 1.0, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 5, 'symptom_id' => 23, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 5, 'symptom_id' => 28, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 6, 'symptom_id' => 6, 'mb' => 1.0, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 6, 'symptom_id' => 9, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 6, 'symptom_id' => 10, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 6, 'symptom_id' => 30, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 6, 'symptom_id' => 31, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 7, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 7, 'symptom_id' => 32, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 7, 'symptom_id' => 38, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 7, 'symptom_id' => 39, 'mb' => 1.0, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 8, 'symptom_id' => 2, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 8, 'symptom_id' => 18, 'mb' => 0.8, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 8, 'symptom_id' => 29, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 9, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 9, 'symptom_id' => 5, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 9, 'symptom_id' => 9, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 9, 'symptom_id' => 40, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 10, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 10, 'symptom_id' => 2, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 10, 'symptom_id' => 22, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 10, 'symptom_id' => 41, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 11, 'symptom_id' => 2, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 11, 'symptom_id' => 36, 'mb' => 1.0, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 11, 'symptom_id' => 37, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 11, 'symptom_id' => 42, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 12, 'symptom_id' => 1, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 12, 'symptom_id' => 17, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 12, 'symptom_id' => 35, 'mb' => 0.8, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 12, 'symptom_id' => 43, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 7, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 8, 'mb' => 1.0, 'md' => 0.0, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 26, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 27, 'mb' => 0.8, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 33, 'mb' => 0.4, 'md' => 0.2, 'created_at' => now()],
            ['disease_id' => 13, 'symptom_id' => 34, 'mb' => 0.6, 'md' => 0.2, 'created_at' => now()],
        ];

        KnowledgeBase::insert($knowledgeBases);
    }
}
