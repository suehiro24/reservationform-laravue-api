<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ApptSlotElqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(10),
            'price' => $this->faker->randomNumber(4),
            'capacity' => $this->faker->randomNumber(1),
            'location' => $this->faker->text(100),
            'note' => null,
            'reservations' => $this->faker->randomNumber(1),
            'start' => $this->faker->dateTimeBetween('+0 days', '+10 days'),
            'end' => $this->faker->dateTimeBetween('+10 days', '+20 days'),
            'is_full' => false,
            'gc_event_id' => null,
        ];
    }
}

