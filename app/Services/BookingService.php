<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Event;
use App\Exceptions\NotEnoughSeatsException;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function createBooking($userId, $eventId, $seats)
    {
        return DB::transaction(function () use ($userId, $eventId, $seats) {
            $event = Event::lockForUpdate()->findOrFail($eventId);

            if ($event->booked_seats + $seats > $event->total_seats) {
                throw new NotEnoughSeatsException("Not enough seats available.");
            }

            $booking = Booking::create([
                'user_id' => $userId,
                'event_id' => $eventId,
                'seats_booked' => $seats,
            ]);

            $event->booked_seats += $seats;
            $event->save();

            return $booking;
        });
    }
}
