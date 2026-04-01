<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $houses = [
            [
                'title' => 'Cluster Minimalis Kontemporer Premium',
                'location' => 'Bintaro, Tangerang Selatan',
                'price' => 'Rp 1.250.000.000',
                'status' => 'Dijual',
                'beds' => 3,
                'baths' => 2,
                'area' => 90,
                'is_new' => true,
                'image' => 'image/desain-rumah-kecil-sederhana-kontemporer.jpg',
                'description' => 'Rumah cluster cantik di kawasan premium Bintaro dengan sistem keamanan 24 jam. Desain kontemporer dengan sirkulasi udara optimal dan pencahayaan alami yang melimpah.'
            ],
            [
                'title' => 'Rumah Skandinavian Asri',
                'location' => 'Kota Baru Parahyangan, Bandung',
                'price' => 'Rp 950.000.000',
                'status' => 'Dijual',
                'beds' => 2,
                'baths' => 1,
                'area' => 72,
                'is_new' => false,
                'image' => 'image/gambar-rumah-sederhana-kecil-skandinavian.jpg',
                'description' => 'Menikmati udara segar pegunungan dari halaman belakang rumah Anda sendiri. Desain skandinavian yang cozy dilengkapi lantai kayu vinyl berkualitas.'
            ],
            [
                'title' => 'Hunian Modern Industrial',
                'location' => 'Canggu, Bali',
                'price' => 'Rp 85.000.000 / thn',
                'status' => 'Disewa',
                'beds' => 3,
                'baths' => 3,
                'area' => 120,
                'is_new' => false,
                'image' => 'image/gambar-rumah-sederhana-kecil-desain-industrial.jpg',
                'description' => 'Villa bergaya industrial yang aesthetic. Cocok untuk digital nomad atau keluarga ekspatriat. Memiliki kolam renang pribadi kecil.'
            ],
            [
                'title' => 'Rumah Mungil Atap Miring Eksklusif',
                'location' => 'Depok, Jawa Barat',
                'price' => 'Rp 650.000.000',
                'status' => 'Dijual',
                'beds' => 2,
                'baths' => 1,
                'area' => 60,
                'is_new' => true,
                'image' => 'image/desain-rumah-kecil-atap-miring.jpg',
                'description' => 'Solusi cerdas hunian modern bagi milenial. Fasad atap miring unik yang sedang trend dengan interior minimalis fungsional.'
            ],
        ];

        foreach ($houses as $house) {
            House::create($house);
        }
    }
}
