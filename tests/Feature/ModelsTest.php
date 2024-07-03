<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_have_many_reservations()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);

        $this->assertInstanceOf(Reservation::class, $user->reservations->first());
    }

    /** @test */
    public function a_room_can_have_many_reservations()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);

        $this->assertInstanceOf(Reservation::class, $room->reservations->first());
    }

    /** @test */
    public function a_reservation_belongs_to_a_user_and_a_room()
    {
        $user = User::factory()->create();
        $room = Room::factory()->create();

        $reservation = Reservation::factory()->create([
            'user_id' => $user->id,
            'room_id' => $room->id,
        ]);

        $this->assertInstanceOf(User::class, $reservation->user);
        $this->assertInstanceOf(Room::class, $reservation->room);
    }
}
