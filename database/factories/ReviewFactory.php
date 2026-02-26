<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Kamar;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kamar_id' => Kamar::inRandomOrder()->first()?->id ?? Kamar::factory(),
            
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),

            'rating' => $this->faker->numberBetween(3, 5),

            'ulasan' => $this->faker->sentence(12),

            'status' => $this->faker->randomElement([
                'pending',
                'approved',
                
            ]),
        ];
    }
}