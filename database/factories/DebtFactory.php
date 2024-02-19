<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Debt::class>
 */
class DebtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id'       => mt_rand(1, 10),
            'jumlah_hutang'     => fake()->numberBetween(50000, 1000000),
            'tgl_pinjam'        => fake()->dateTimeBetween('2023-09-15', '2023-10-25'),
            'tgl_jatuh_tempo'   => fake()->dateTimeBetween('2023-10-31', '2023-11-25'),
            'keterangan'        => fake()->randomElement(['Lunas', 'Belum Lunas'])
        ];
    }
}
