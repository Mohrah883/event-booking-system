<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'booking_id' => $this->id,
            'event_name' => $this->event->name ?? null,
            'seats_booked' => $this->seats_booked,
            'remaining_seats' => $this->event
                ? $this->event->total_seats - $this->event->booked_seats
                : null,
        ];
    }
}