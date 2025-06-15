<?php

/**
 * @OA\Info(
 *     title="Event Booking API",
 *     version="1.0",
 *     description="API documentation for booking events",
 *     @OA\Contact(
 *         email="mohrahalzkari3@gmail.com"
 *     )
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::post('/bookings', [BookingController::class, 'store']);
