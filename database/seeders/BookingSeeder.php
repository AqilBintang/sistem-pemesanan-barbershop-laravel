<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Barber;
use App\Models\Service;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $barbers = Barber::all();
        $services = Service::all();

        if ($barbers->isEmpty() || $services->isEmpty()) {
            $this->command->info('Please run BarberSeeder and ServiceSeeder first');
            return;
        }

        $bookings = [
            [
                'customer_name' => 'Ahmad Rizki',
                'customer_phone' => '081234567890',
                'customer_email' => 'ahmad.rizki@email.com',
                'booking_date' => Carbon::today(),
                'booking_time' => '09:00',
                'status' => 'confirmed',
                'notes' => 'Mohon potong rambut tidak terlalu pendek',
            ],
            [
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567891',
                'customer_email' => 'budi.santoso@email.com',
                'booking_date' => Carbon::today(),
                'booking_time' => '10:30',
                'status' => 'pending',
                'notes' => null,
            ],
            [
                'customer_name' => 'Candra Wijaya',
                'customer_phone' => '081234567892',
                'customer_email' => null,
                'booking_date' => Carbon::tomorrow(),
                'booking_time' => '14:00',
                'status' => 'confirmed',
                'notes' => 'Ingin gaya rambut modern',
            ],
            [
                'customer_name' => 'Dedi Kurniawan',
                'customer_phone' => '081234567893',
                'customer_email' => 'dedi.k@email.com',
                'booking_date' => Carbon::yesterday(),
                'booking_time' => '16:30',
                'status' => 'completed',
                'notes' => null,
            ],
            [
                'customer_name' => 'Eko Prasetyo',
                'customer_phone' => '081234567894',
                'customer_email' => 'eko.prasetyo@email.com',
                'booking_date' => Carbon::today()->addDays(2),
                'booking_time' => '11:00',
                'status' => 'pending',
                'notes' => 'Booking untuk acara pernikahan',
            ],
        ];

        foreach ($bookings as $bookingData) {
            $barber = $barbers->random();
            $service = $services->random();
            
            Booking::create([
                'customer_name' => $bookingData['customer_name'],
                'customer_phone' => $bookingData['customer_phone'],
                'customer_email' => $bookingData['customer_email'],
                'barber_id' => $barber->id,
                'service_id' => $service->id,
                'booking_date' => $bookingData['booking_date'],
                'booking_time' => $bookingData['booking_time'],
                'status' => $bookingData['status'],
                'notes' => $bookingData['notes'],
                'total_price' => $service->price,
            ]);
        }

        $this->command->info('Sample bookings created successfully!');
    }
}