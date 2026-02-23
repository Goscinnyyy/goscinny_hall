<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = fake()->time();
        $endHour = (int)substr($startTime, 0, 2) + fake()->numberBetween(1, 8);
        $endTime = str_pad($endHour % 24, 2, '0', STR_PAD_LEFT) . substr($startTime, 2);

        return [
            'user_id' => User::factory(),
            'hall_id' => Hall::factory(),
            'booking_date' => fake()->dateTimeBetween('+1 day', '+30 days'),
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
