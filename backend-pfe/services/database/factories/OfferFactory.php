<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        return [
            'client_id' => Utilisateur::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'budget' => $this->faker->randomFloat(2, 100, 10000),
            'status' => $this->faker->randomElement(['open', 'closed']),
        ];
    }
}

