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
        Utilisateur::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'), 
            'experience' => '3la moulanaaa bismilaaaahh'
        ]);

        Utilisateur::create([
            'name' => 'Si Saidi',
            'email' => 'saidi@example.com',
            'password' => Hash::make('password123'), 
            'experience' => 'wld lbladd',
            'role'=>'developer'
        ]);

        Utilisateur::factory()->count(9)->create();
    }
}
