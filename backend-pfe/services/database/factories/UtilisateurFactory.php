<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utilisateur;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UtilisateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Utilisateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = ['client', 'developer'];
        // Directory containing the downloaded images
        $directory = 'avatars';

        // Get all files in the directory
        $files = File::allFiles(public_path($directory));

        // Get a random image file
        $randomFile = $files[array_rand($files)];

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Default password for testing purposes
            'avatar' => $directory . '/' . $randomFile->getFilename(),
            'role' => $this->faker->randomElement($roles),
            'status' => 'active',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'programming_languages' => $this->faker->words(3, true), // Random programming languages for developers
            'frameworks' => $this->faker->words(3, true), // Random frameworks for developers
            'experience' => $this->faker->paragraph, // Random experience description for developers
        ];
    }

    /**
     * Define a specific role for the user.
     *
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function role(string $role)
    {
        return $this->state([
            'role' => $role,
        ]);
    }

    /**
     * Define a specific status for the user.
     *
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function status(string $status)
    {
        return $this->state([
            'status' => $status,
        ]);
    }
}
