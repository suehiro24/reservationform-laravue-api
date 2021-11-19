<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseElqFactory extends Factory
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
            'description' => $this->faker->text(100),
            'is_finished' => false,
            'is_deleted' => false
        ];
    }
}
