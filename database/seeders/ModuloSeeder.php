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
        ['codigo' => 'ACD', 'nombre' => 'Acceso a datos', 'horas' => 120, 'curso' => 2, 'id_ciclo' => 1],
        ['codigo' => 'DI', 'nombre' => 'Desarrollo de interfaces' => 140, 'curso' => 2, 'id_ciclo' => 1],
        ['codigo' => 'PMDM', 'nombre' => 'Programación multimedia y dispositivos móviles', 'horas' => 100, 'curso' => 2, 'id_ciclo' => 1],
        ['codigo' => 'PSP', 'nombre' => 'Programación de servicios y procesos', 'horas' => 80, 'curso' => 2, 'id_ciclo' => 1],
        ['codigo' => 'SGE', 'nombre' => 'Sistemas de gestión empresarial', 'horas' => 100, 'curso' => 2, 'id_ciclo' => 1],
    ]);
}
}
