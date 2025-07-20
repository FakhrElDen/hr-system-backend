<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'position' => $this->faker->jobTitle(),
            'salary' => $this->faker->randomFloat(2, 3000, 15000),
            'hired_at' => $this->faker->date(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}
