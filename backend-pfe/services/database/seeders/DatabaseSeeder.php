<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Offer;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 clients and their offers
        Utilisateur::factory(10)->create(['role' => 'client'])
            ->each(function ($client) {
                Offer::factory(3)->create(['client_id' => $client->id]);
            });

        // Create 10 developers and their reviews
        Utilisateur::factory(10)->create(['role' => 'developer'])
            ->each(function ($developer) {
                Review::factory(3)->create(['user_id' => $developer->id]);
            });
    }
}
