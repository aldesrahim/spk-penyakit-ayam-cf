<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            [
                'name' => 'Berak Kapur (Pullorum Disease)',
                'description' => 'Pullorum Disease disebut juga Bacillary White Diarrhea dan yang lebih popular disebut penyakit berak kapur atau berak putih.',
                'suggestion' => "Berikan Master Coliprim dosis: 1 gr/1 ltr air selama 3-4 hari (1/2 hari) berturut-turut. setelah itu berikan Master Vit-Stress selama 3-4 hari untuk membantu proses penyembuhan.",
                'image_path' => 'public/diseases-image/01BerakKapur.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Kolera Ayam (Fowl Cholera)',
                'description' => 'Penyakit Fowl Cholera merupakan penyakit ayam yang dapat menyerang secara pelan-pelan dan juga dapat menyerang secara mendadak.',
                'suggestion' => "Berikan Master Kolericid dosis: 1 gr/1 ltr air selama 3-4 hari berturut-turut. berikan Master Vit-Stress dosis: 1 gr/3 ltr air untuk membantu proses penyembuhan.",
                'image_path' => 'public/diseases-image/02KoleraAyam.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Flu Burung (Avian Influenza)',
                'description' => 'Penyakit Avian Influenza, disebut juga penyakit Fowl Plaque. Pertama kali terjadi di Italia sekitar tahun 1800. Selanjutnya menyebar luas sampai tahun 1930, setelah itu menjadi sporadis dan terlokalisasi terutama di timur tengah.',
                'suggestion' => "Tidak ada obat.\nDianjurkan untuk disingkirkan dan dimusnakan dengan cara dibakar dan bangkainya dikubur.",
                'image_path' => 'public/diseases-image/03FluBurung.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Tetelo (Newcastle Disease)',
                'description' => 'Penyakit Newcastle Disease disebut juga Pseudovogel pest Rhaniket, Pheumoencephalitis, Tortor Furrens, dan di Indonesia popular dengan sebutan tetelo. Penyakit ini pertama kali ditemukan oleh Doyle pada tahun 1927, didaerah Newcastle on Tyne, Inggris',
                'suggestion' => "Vaksinasi harus dilakukan untuk memperoleh kekebalan. Jenis vaksin yang kami gunakan adalah ND Lasota yang kami beli dari PT. SHS. Vaksinasi ND yang pertama, kami lakukan dengan cara pemberian melalui tetes mata pada hari ke 2. Untuk berikutnya pemberian vaksin kami lakukan dengan cara suntikan di intramuskuler otot dada.",
                'image_path' => 'public/diseases-image/04Tetelo.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Tipus Ayam (Fowl Typhoid)',
                'description' => 'Penyakit Fowl Typhoid dikenal sebagai penyakit tipus ayam, tergolong penyakit menular.',
                'suggestion' => "Berikan Neo Terramycin dosis: 2 sendok teh/3,8 ltr air selama 3-4 hari berturut-turut.",
                'image_path' => 'public/diseases-image/05Tipus Ayam.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Berak Darah (Coccidosis)',
                'description' => 'Coccidosis merupakan penyakit menular yang ganas, dikalangan para peternak ayam disebut juga penyakit berak darah. Penyakit ini ditemukan pada tahun 1674.',
                'suggestion' => "Berikan Master Coliprim dosis: 1gr/1 ltr air selama 3-4 hari (1/2 hari) berturut-turut. setelah pengobatan berikan Vitamin Master Vit-Stress dosis: 1gr/3 ltr selama 3-4 hari berturut-turut.",
                'image_path' => 'public/diseases-image/06Berak Darah.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Gumboro (Infectious Bursal Disease)',
                'description' => 'Penyakit Gumboro, disebut juga Infectious Bursal Disease. Pertama kali ditemukan dan dilaporkan pada tahun 1975 oleh Dr. Csgrove di daerah Gumboro, Deleware, Amerika Serikat.',
                'suggestion' => "Tidak ada obat.\nAir gula 30-50 gr/ltr air dan ditambah Master Vit-Stress dosis: 1 gr/2 ltr air untuk meningkatkan kondisi tubuh.",
                'image_path' => 'public/diseases-image/07Gumboro.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Salesma Ayam (Infectious Coryza)',
                'description' => 'Penyakit Infectious Coryza disebut juga Infectious Cold, Snot, Rhinitis, Roup atau yang populer disebut salesma ayam.',
                'suggestion' => "Berikan Master Cyprosyn-Plus dosis: 1 gr/1 ltr air selama 3-4 hari berturut-turut. selama pengobatan berikan vitamin Master Vit-Stress dosis: 1 gr/3 ltr air untuk membantu proses pengobatan.",
                'image_path' => 'public/diseases-image/08Snot.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Batuk Ayam Menahun (Infectious Bronchitis)',
                'description' => 'Penyakit Infectious Bronchitis pertama kali ditemukan pada tahun 1930 dan penyakit ini mulai menjadi wabah sejak tahun 1940. Pada tahun 1950 penyakit Infectious Bronchitis sudah dapat dikendalikan dengan efektif.',
                'suggestion' => "Tidak ada obat.\nBerikan vitamin Master Vit-Stress dosis: 1 gr/1 ltr air untuk memperbaiki kondisi tubuh",
                'image_path' => 'public/diseases-image/09IB.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Busung Ayam (Lymphoid Leukosis)',
                'description' => 'Penyakit Lymphoid Leukosis termasuk kelompok Leukosis Komplex Disease. Penyakit ini banyak menyerang ayam di Indonesia.',
                'suggestion' => "Tidak ada obat.\nSegera disingkirkan atau dimusnakan.",
                'image_path' => 'public/diseases-image/10BusungAyam.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Batuk Darah (Infectious Laryngo Tracheitis)',
                'description' => 'Penyakit Infectious Laryngotracheitis disebut juga Infectious Tracheitis. Jenis penyakit ini ditemukan pada tahun 1925, dan secara resmi diakui oleh Committee on Poultry Disease of the American Veterinary Medical Association, pada tahun 1931.',
                'suggestion' => "Tidak ada obat.\nBerikan vitamin Master Vit-Stress dosis: 1 gr/1 ltr air untuk membantu memperbaiki kondisi tubuh.",
                'image_path' => 'public/diseases-image/11Batuk Darah.png',
                'created_at' => now(),
            ],
            [
                'name' => 'Mareks (Mareks Disease)',
                'description' => 'Penyakit Mareks Disease pada awalnya dimasukan dalam kelompok Leukosis Complex Disease. Namun setelah ditemukan penyebabnya dan penanggulangannya, penyakit ini dipisahkan dari kelompok Leukosis Complex Disease.',
                'suggestion' => "Tidak ada obat.\nDianjurkan untuk disingkirkan dan dimusnakan dengan cara dibakar dan bangkainya dikubur.",
                'image_path' => 'public/diseases-image/12 Marek.jpg',
                'created_at' => now(),
            ],
            [
                'name' => 'Produksi Telur (Egg Drop Syndrome 76/EDS 76)',
                'description' => 'Penyakit Egg Drop Syndrome, merupakan penyakit ayam yang pada tahu 1976, dilaporkan van Eck di Nederland. Dikalangan pakar kesehatan ternak, penyakit itu disebut Egg Drop Syndrome 76.',
                'suggestion' => "Tidak ada obat.\nBerikan vitamin untuk membantu kondisi tubuh.",
                'image_path' => 'public/diseases-image/13EDS.jpg',
                'created_at' => now(),
            ],
        ];

        Disease::insert($diseases);
    }
}
