<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee::class>
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
            // 'user_id'       => mt_rand(1, 3),
            'salary_id'     => mt_rand(1, 5),
            'nama'          => fake('id_ID')->name(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'umur'          => fake()->numberBetween(18, 35),
            'no_telp'       => fake('id_ID')->phoneNumber(),
            'tgl_masuk'     => fake()->dateTimeBetween('2023-7-1', '2023-12-31'),
            'status'        => mt_rand(1, 3)
        ];
    }
}
