<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear profesores
        User::factory()->conRolProfesor()->count(20)->create();
        // Crear estudiantes
        User::factory()->conRolEstudiante()->count(50)->create();
    }
}
