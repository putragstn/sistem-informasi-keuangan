<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'   => mt_rand(1, 6),
            'user_id'       => mt_rand(1, 2),
            'tanggal'       => fake()->dateTimeBetween('2023-10-20', '2023-11-20'),
            'nominal'       => fake()->numberBetween(200000, 1000000)
        ];
        // dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
    }
}
