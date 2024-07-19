<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = (clone $startDate)->modify('+'.rand(0, 3).' days');
        return [
            'user_id'       => 1,
            'name'          => $this->faker->word,
            'category'      => $this->faker->randomElement(['Music', 'Festival', 'FoodCourt']),
            'description'   => $this->faker->paragraph(3),
            'start_date'    => $startDate->format('Y-m-d'),
            'end_date'      => $endDate->format('Y-m-d'),
            'location'      => $this->faker->address,
            'status'        => $this->faker->boolean(),
        ];
    }
}
