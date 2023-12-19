<?php

namespace Database\Seeders;

use App\Models\Symptom;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $symptoms = [
            ['name' => 'Nafsu makan berkurang', 'created_at' => now()],
            ['name' => 'Nafas sesak / megap-megap', 'created_at' => now()],
            ['name' => 'Nafas ngorok basah', 'created_at' => now()],
            ['name' => 'Bersin-bersin', 'created_at' => now()],
            ['name' => 'Batuk', 'created_at' => now()],
            ['name' => 'Bulu kusam dan berkerut', 'created_at' => now()],
            ['name' => 'Diare', 'created_at' => now()],
            ['name' => 'Produksi telur menurun', 'created_at' => now()],
            ['name' => 'Kedinginan', 'created_at' => now()],
            ['name' => 'Tampak lesu', 'created_at' => now()],
            ['name' => 'Mencret kehijau-hijauan', 'created_at' => now()],
            ['name' => 'Mencret keputih-putihan', 'created_at' => now()],
            ['name' => 'Muka pucat', 'created_at' => now()],
            ['name' => 'Nampak membiru', 'created_at' => now()],
            ['name' => 'Pembengkakan pial', 'created_at' => now()],
            ['name' => 'Jengger pucat', 'created_at' => now()],
            ['name' => 'Kaki dan sayap lumpuh', 'created_at' => now()],
            ['name' => 'Keluar cairan dari mata dan hidung', 'created_at' => now()],
            ['name' => 'Kepala bengkak', 'created_at' => now()],
            ['name' => 'Kepala terputar', 'created_at' => now()],
            ['name' => 'Pembengkakan dari sinus dan mata', 'created_at' => now()],
            ['name' => 'Perut membesar', 'created_at' => now()],
            ['name' => 'Sayap menggantung', 'created_at' => now()],
            ['name' => 'Terdapat kotoran putih menempel disekitar anus', 'created_at' => now()],
            ['name' => 'Mati secara mendadak', 'created_at' => now()],
            ['name' => 'Kerabang telur kasar', 'created_at' => now()],
            ['name' => 'Putih Telur Encer', 'created_at' => now()],
            ['name' => 'Kotoran kuning kehijauan', 'created_at' => now()],
            ['name' => 'Pembengkakan daerah fasial dan sekitar mata', 'created_at' => now()],
            ['name' => 'Kotoran atau feses berdarah', 'created_at' => now()],
            ['name' => 'Bergerombol di sudut kandang', 'created_at' => now()],
            ['name' => 'Mematuk daerah kloaka', 'created_at' => now()],
            ['name' => 'Kerabang telur pucat', 'created_at' => now()],
            ['name' => 'Telur lebih kecil', 'created_at' => now()],
            ['name' => 'Kelumpuhan pada tembolok', 'created_at' => now()],
            ['name' => 'Bernafas dengan mulut sambil menjulurkan leher', 'created_at' => now()],
            ['name' => 'Batuk berdarah', 'created_at' => now()],
            ['name' => 'Tidur paruhnya diletakkan dilantai', 'created_at' => now()],
            ['name' => 'Duduk dengan sikap membungkuk', 'created_at' => now()],
            ['name' => 'Kelihatan mengantuk dengan bulu berdiri', 'created_at' => now()],
            ['name' => 'Badan kurus', 'created_at' => now()],
            ['name' => 'Terdapat lendir bercampur darah pada rongga mulut', 'created_at' => now()],
            ['name' => 'Kaki pincang', 'created_at' => now()],
        ];

        Symptom::insert($symptoms);
    }
}
