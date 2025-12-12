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
                'name' => 'Budi Santoso',
                'level' => 'master',
                'experience' => '12 Tahun',
                'specialty' => 'All Styles & Hair Art',
                'bio' => 'Maestro dalam semua teknik potong rambut dengan keahlian yang tak tertandingi. Pengalaman lebih dari satu dekade dalam industri barbershop.',
                'skills' => ['All Styles', 'Hair Art', 'Premium Cut'],
                'schedule' => 'Selasa - Minggu: 10:00 - 19:00',
                'rating' => 5.0,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmad Rizki',
                'level' => 'senior',
                'experience' => '8 Tahun',
                'specialty' => 'Modern & Classic Cut',
                'bio' => 'Spesialis gaya rambut modern dan klasik dengan sentuhan artistik yang memukau. Berpengalaman dalam berbagai teknik potong rambut profesional.',
                'skills' => ['Fade Cut', 'Pompadour', 'Beard Styling'],
                'schedule' => 'Senin - Sabtu: 09:00 - 18:00',
                'rating' => 4.9,
                'is_active' => true,
            ],
            [
                'name' => 'Dedi Kurniawan',
                'level' => 'professional',
                'experience' => '6 Tahun',
                'specialty' => 'Trendy Cut & Treatment',
                'bio' => 'Spesialis gaya rambut trendy dan treatment rambut premium untuk penampilan maksimal yang memukau.',
                'skills' => ['Trendy Cut', 'Hair Treatment', 'Styling'],
                'schedule' => 'Senin - Sabtu: 11:00 - 20:00',
                'rating' => 4.8,
                'is_active' => true,
            ],
            [
                'name' => 'Eko Prasetyo',
                'level' => 'junior',
                'experience' => '3 Tahun',
                'specialty' => 'Modern Cut & Youth Style',
                'bio' => 'Kapster muda dengan teknik modern dan semangat tinggi untuk memberikan yang terbaik bagi setiap pelanggan.',
                'skills' => ['Modern Cut', 'Youth Style', 'Quick Service'],
                'schedule' => 'Senin - Minggu: 09:00 - 21:00',
                'rating' => 4.7,
                'is_active' => true,
            ],
            [
                'name' => 'Fajar Ramadhan',
                'level' => 'specialist',
                'experience' => '7 Tahun',
                'specialty' => 'Beard Expert & Classic',
                'bio' => 'Ahli dalam perawatan jenggot dan gaya rambut klasik dengan teknik tradisional terbaik yang telah teruji.',
                'skills' => ['Beard Expert', 'Classic Cut', 'Mustache'],
                'schedule' => 'Rabu - Minggu: 10:00 - 18:00',
                'rating' => 4.9,
                'is_active' => true,
            ],
            [
                'name' => 'Gilang Pratama',
                'level' => 'creative',
                'experience' => '5 Tahun',
                'specialty' => 'Creative Cut & Hair Art',
                'bio' => 'Kreatif dalam menciptakan gaya rambut unik dan artistik yang memukau setiap mata yang melihatnya.',
                'skills' => ['Creative Cut', 'Hair Art', 'Unique Style'],
                'schedule' => 'Selasa - Sabtu: 12:00 - 21:00',
                'rating' => 4.6,
                'is_active' => true,
            ],
        ];

        foreach ($barbers as $barber) {
            Barber::create($barber);
        }
    }
}