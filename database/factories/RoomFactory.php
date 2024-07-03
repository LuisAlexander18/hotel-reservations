<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'room_number' => $this->faker->unique()->numberBetween(1, 100),
            'type' => $this->faker->randomElement(['single', 'double', 'suite']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['available', 'occupied']),
        ];
    }
}
