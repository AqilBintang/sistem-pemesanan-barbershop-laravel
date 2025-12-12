<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Paket Lengkap',
                'description' => 'Kombinasi semua layanan premium dengan harga hemat untuk pengalaman terbaik',
                'price' => 75000,
                'duration' => 60,
                'type' => 'paket',
                'features' => ['Potong rambut premium', 'Cukur jenggot', 'Hair treatment'],
                'is_active' => true,
            ],
            [
                'name' => 'Keramas + Creambath',
                'description' => 'Perawatan rambut relaksasi dengan produk premium untuk kesehatan rambut optimal',
                'price' => 30000,
                'duration' => 25,
                'type' => 'populer',
                'features' => ['Shampo premium', 'Creambath treatment', 'Pijat kepala relaksasi'],
                'is_active' => true,
            ],
            [
                'name' => 'Potong Rambut Anak',
                'description' => 'Layanan khusus untuk anak-anak dengan pendekatan ramah dan suasana nyaman',
                'price' => 25000,
                'duration' => 25,
                'type' => 'ekonomis',
                'features' => ['Pendekatan ramah anak', 'Gaya rambut sesuai usia', 'Suasana nyaman & aman'],
                'is_active' => true,
            ],
            [
                'name' => 'Potong Rambut Basic',
                'description' => 'Gaya klasik dan modern untuk penampilan sehari-hari yang rapi dan profesional',
                'price' => 35000,
                'duration' => 30,
                'type' => 'ekonomis',
                'features' => ['Konsultasi gaya rambut gratis', 'Potong rambut profesional'],
                'is_active' => true,
            ],
            [
                'name' => 'Potong Rambut Premium',
                'description' => 'Layanan lengkap dengan styling profesional dan treatment untuk hasil maksimal',
                'price' => 55000,
                'duration' => 45,
                'type' => 'premium',
                'features' => ['Konsultasi mendalam & analisis', 'Styling profesional premium'],
                'is_active' => true,
            ],
            [
                'name' => 'Cukur Jenggot',
                'description' => 'Perawatan jenggot profesional dengan teknik tradisional untuk tampilan maskulin',
                'price' => 25000,
                'duration' => 20,
                'type' => 'populer',
                'features' => ['Trimming jenggot presisi', 'Shaping profesional'],
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}