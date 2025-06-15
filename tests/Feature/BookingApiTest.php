<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_book_seats_successfully()
    {
        $user = User::factory()->create();

        $event = Event::factory()->create([
            'name' => 'Concert A',
            'location' => 'Riyadh',
            'total_seats' => 100,
            'booked_seats' => 0,
            'start_time' => now()->addDays(1),
            'end_time' => now()->addDays(1)->addHours(2),
        ]);

        $response = $this->actingAs($user)->postJson('/api/bookings', [
            'event_id' => $event->id,
            'seats_booked' => 3,
        ]);

        $response->dump(); // يشوف الرد لو فيه خطأ
        $response->assertStatus(200);

        $this->assertDatabaseHas('bookings', [
            'event_id' => $event->id,
            'seats_booked' => 3,
        ]);
    }
}
