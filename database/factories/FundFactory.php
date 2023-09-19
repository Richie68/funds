<?php

namespace Database\Factories;

use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fund>
 */
class FundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => ucwords(fake()->word()),
            'start' => fake()->dateTimeBetween('- 2 years', '+ 3 years'),
            'manager_uuid' => Manager::all()->random()->uuid,
        ];
    }
}
