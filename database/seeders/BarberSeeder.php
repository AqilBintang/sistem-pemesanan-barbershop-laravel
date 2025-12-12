<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barber;

class BarberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barbers = [
            [
                'name' => 'Ahmad Rizki',
                'experience' => '5 tahun',
                'specialty' => 'Modern Cut & Styling',
                'bio' => 'Spesialis gaya rambut modern dengan pengalaman di salon premium. Ahli dalam teknik fade dan undercut.',
                'rating' => 4.8,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'experience' => '3 tahun',
                'specialty' => 'Classic Style & Beard',
                'bio' => 'Fokus pada gaya klasik dan perawatan jenggot. Memberikan pelayanan yang detail dan profesional.',
                'rating' => 4.7,
                'is_active' => true,
            ],
            [
                'name' => 'Dedi Kurniawan',
                'experience' => '7 tahun',
                'specialty' => 'Beard Expert & Traditional',
                'bio' => 'Master dalam seni cukur tradisional dan perawatan jenggot. Pengalaman luas dengan berbagai teknik.',
                'rating' => 4.9,
                'is_active' => true,
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}