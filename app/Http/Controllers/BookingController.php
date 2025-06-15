<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Services\BookingService;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Book seats for an event",
     *     tags={"Bookings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"event_id", "seats_booked"},
     *             @OA\Property(property="event_id", type="integer", example=1),
     *             @OA\Property(property="seats_booked", type="integer", example=2)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking successful",
     *         @OA\JsonContent(ref="#/components/schemas/Booking")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
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
