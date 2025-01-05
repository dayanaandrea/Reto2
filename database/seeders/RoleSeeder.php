<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role' => 'profesor', 'description' => 'Profesorado del centro de Elorrieta-Errekamari.', 'created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'estudiante', 'description' => 'Alumnado del centro de Elorrieta-Errekamari.', 'created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'administrador', 'description' => 'Administración del centro de Elorrieta-Errekamari.','created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'god', 'description' => 'Gestor del centro de Elorrieta-Errekamari.', 'created_at'=>now(), 'updated_at'=> now()]
        ]);
    }
}
