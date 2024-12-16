<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstName();
        $lastname = fake()->lastName();

        return [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $this->generateUniqueEmail($name, $lastname),
            'email_verified_at' => now(),
            'password' => '1234',
            'remember_token' => Str::random(10),
            'address' => fake()->address(),
            'phone1' => fake()->phoneNumber(),
            'pin' => fake()->numberBetween(11111111, 99999999) . chr(rand(65, 90)),
            'created_at' => now(),
            'updated_at' => now(),
            'role_id' => 1 // valor por defecto, se asigna después
        ];
    }

    /**
     * Genera un correo único basado en el nombre y apellido.
     */
    private function generateUniqueEmail($name, $lastname)
    {
        // Generar el correo en formato nombre.apellido@elorrieta-errekamari.com
        $email = strtolower($name . '.' . $lastname) . '@elorrieta-errekamari.com';

        if (User::where('email', $email)->exists()) {
            $email = strtolower($name . '.' . $lastname . '.' . fake()->randomNumber(2)) . '@elorrieta-errekamari.com';
        }

        return $email;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Crear un usuario con rol 1 - PROFESOR
     */
    public function conRolProfesor(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 1,
        ]);
    }

    /**
     * Crear un usuario con rol 2 - ESTUDIANTE
     */
    public function conRolEstudiante(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 2,
        ]);
    }
}
