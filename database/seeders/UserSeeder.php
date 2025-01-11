<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el usuario GOD, es el primero por lo que tiene ID 1
        DB::table('users')->insert([
            [
                'name' => 'God',
                'lastname' => 'God',
                'email' => 'god@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'pin' => '11111111A',
                'address' => 'Camino de los Dioses, 10, 2B',
                'phone1' => '666666666',
                'role_id' => 4
            ]
        ]);

        // Crear un usuario admin
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'lastname' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'pin' => '11111111B',
                'address' => 'Camino de los Dioses, 10, 2B',
                'phone1' => '666666666',
                'role_id' => 3
            ]
        ]);

        // Crear un usuario profesor
        DB::table('users')->insert([
            [
                'name' => 'Profesor',
                'lastname' => 'Profesor',
                'email' => 'profesor@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'pin' => '11111111C',
                'address' => 'Camino de los Dioses, 10, 2B',
                'phone1' => '666666666',
                'role_id' => 1
            ]
        ]);

        // Crear un usuario estudiante
        DB::table('users')->insert([
            [
                'name' => 'Estudiante',
                'lastname' => 'Estudiante',
                'email' => 'estudiante@admin.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'pin' => '11111111D',
                'address' => 'Camino de los Dioses, 10, 2B',
                'phone1' => '666666666',
                'role_id' => 2
            ]
        ]);

        // Crear profesores
        User::factory()->conRolProfesor()->count(20)->create();
        // Crear estudiantes
        User::factory()->conRolEstudiante()->count(50)->create();
    }
}
