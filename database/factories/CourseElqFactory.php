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
            'name' => 'test course',
            'price' => 100,
            'capacity' => 10,
            'location' => 'test location',
            'description' => 'test description',
            'is_finished' => false,
            'is_deleted' => false
        ];
    }
}
