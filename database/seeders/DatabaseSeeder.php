<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('secret'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Guest',
            'email' => 'guest@mail.com',
            'password' => Hash::make(Str::random(40)),
        ]);

        $this->call([
            SymptomSeeder::class,
            DiseaseSeeder::class,
            KnowledgeBaseSeeder::class,
        ]);
    }
}
