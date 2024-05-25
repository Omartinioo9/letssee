<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create a known user with a hashed password for testing
        Utilisateur::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'), 
            'experience'=>'3la moulanaaa bismilaaaahh'
        ]);

        // Create additional users if needed
        Utilisateur::factory()->count(9)->create();
    }
}
