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
        User::factory()->withRole1()->count(20)->create();
        // Crear estudiantes
        User::factory()->withRole2()->count(50)->create();
    }
}
