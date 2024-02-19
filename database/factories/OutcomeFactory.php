<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Outcome::class>
 */
class OutcomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'   => mt_rand(1, 7),
            'user_id'       => mt_rand(1, 2),
            'tanggal'       => fake()->dateTimeBetween('2023-10-20', '2023-11-20'),
            'nominal'       => fake()->numberBetween(200000, 800000)
        ];
    }
}
