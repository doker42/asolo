<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip'       => fake()->ipv4(),
            'location' => fake()->city(),
            'visited_date' => fake()->date(),
            'hits'     => fake()->numberBetween(1, 100),
        ];
    }
}
