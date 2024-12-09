<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'nombre' => 'God', 
                'apellidos' => 'God', 
                'email' => 'god@admin.com',
                'email_verified_at' => now(), 
                'password' => bcrypt('1234'), 
                'remember_token' => Str::random(10), 
                'created_at'=>now(), 
                'updated_at'=> now(),
                'dni' => '11111111A',
                'direccion' => 'Camino de los Dioses, 10, 2B',
                'tlf1' => '666666666',
                'id_rol' => 4
            ]
        ]);

        // Crear profesores
        User::factory()->conRolProfesor()->count(20)->create();
        // Crear estudiantes
        User::factory()->conRolEstudiante()->count(50)->create();
    }
}
