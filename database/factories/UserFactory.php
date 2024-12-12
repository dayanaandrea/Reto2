<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        return [
            'name' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'address' => fake()->address(),
            'phone1' => fake() -> phoneNumber(),
            'pin' => fake() -> numberBetween(11111111, 99999999) . chr(rand(65, 90)),
            'created_at' => now(),
            'updated_at'=> now(),
            'role_id' => 1 // valor por defecto, se asigna después
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

        /**
     * Crear un usuario con rol 1 - PROFESOR
     */
    public function conRolProfesor(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => 1,
        ]);
    }

    /**
     * Crear un usuario con rol 2 - ESTUDIANTE
     */
    public function conRolEstudiante(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => 2,
        ]);
    }
}
