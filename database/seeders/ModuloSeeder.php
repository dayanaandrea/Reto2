<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('modulos')->insert([
        ['codigo' => 'modulo1', 'nombre' => 'Módulo 1', 'horas' => 30, 'curso' => 1, 'id_ciclo' => 1],
        ['codigo' => 'modulo2', 'nombre' => 'Módulo 2', 'horas' => 40, 'curso' => 2, 'id_ciclo' => 1],
        ['codigo' => 'modulo3', 'nombre' => 'Módulo 3', 'horas' => 35, 'curso' => 1, 'id_ciclo' => 2],
    ]);
}
}
