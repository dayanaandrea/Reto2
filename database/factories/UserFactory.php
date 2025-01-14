<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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

        // Quitar posibles espacios en blanco
        $name_ = str_replace(' ', '', $name);
        $lastname_ = str_replace(' ', '', $lastname);

        return [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $this->generateUniqueEmail($name_, $lastname_),
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
        // Quitar posibles tildes
        $name = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $lastname = iconv('UTF-8', 'ASCII//TRANSLIT', $lastname);

        // Generar el correo en formato nombre.apellido@elorrieta-errekamari.com
        $emailBase = strtolower($name . '.' . $lastname) . '@elorrieta-errekamari.com';

        // Comprobar si el correo ya existe
        $email = $emailBase;
        $counter = 1;

        while (User::where('email', $email)->exists()) {
            // Si existe, se agrega un número aleatorio al correo
            $email = strtolower($name . '.' . $lastname . '.' . $counter) . '@elorrieta-errekamari.com';
            $counter++;
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

    /**
     * Crear un usuario con rol 3 - ADMINISTRADOS
     */
    public function conRolAdministrador(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 3,
        ]);
    }
    /**
     * Crear un usuario con rol 4 - GOD
     */
    public function conRolGod(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 4,
        ]);
    }

    /**
     * Crear un usuario con un ID personalizado
     */
    public function conId(int $id): static
    {
        return $this->state(fn(array $attributes) => [
            'id' => $id,
        ]);
    }
}
