<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function store(StoreBookingRequest $request)
    {
        $userId = Auth::id() ?? 1;

        $booking = $this->bookingService->createBooking(
            $userId,
            $request->input('event_id'),
            $request->input('seats_booked')
        );

        return new BookingResource($booking);
    }
}
