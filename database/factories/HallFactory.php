<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->word() . ' Hall',
            'price'       => fake()->numberBetween(500000, 5000000),
            'pathGambar'  => 'halls/default.jpg',
            'description' => fake()->sentence(10), // WAJIB TAMBAHKAN INI
        ];
    }
}
