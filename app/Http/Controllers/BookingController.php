<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\BarberSchedule;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function getAvailableBarbers(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today'
        ]);

        $date = $request->date;
        $barbers = Barber::getAvailableForDate($date);

        return response()->json([
            'success' => true,
            'date' => $date,
            'day_name' => Carbon::parse($date)->locale('id')->dayName,
            'barbers' => $barbers->map(function($barber) use ($date) {
                $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
                $schedule = $barber->schedules()->where('day_of_week', $dayOfWeek)->first();
                
                return [
                    'id' => $barber->id,
                    'name' => $barber->name,
                    'level' => $barber->level_display,
                    'photo' => $barber->photo ? asset('storage/' . $barber->photo) : null,
                    'rating' => $barber->formatted_rating,
                    'specialty' => $barber->specialty,
                    'schedule' => $schedule ? $schedule->formatted_time : null,
                ];
            })
        ]);
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $barber = Barber::findOrFail($request->barber_id);
        $isAvailable = $barber->isAvailableOnDate($request->date);

        return response()->json([
            'success' => true,
            'available' => $isAvailable,
            'barber' => $barber->name,
            'date' => $request->date
        ]);
    }
}
