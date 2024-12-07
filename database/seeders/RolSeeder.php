<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['rol' => 'Profesor', 'created_at'=>now()],
            ['rol' => 'Estudiante', 'created_at'=>now()],
            ['rol' => 'Administrador', 'created_at'=>now()],
            ['rol' => 'God', 'created_at'=>now()]
        ]);
    }
}
