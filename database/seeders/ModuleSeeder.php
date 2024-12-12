<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('modules')->insert([
        //se insertan 5 módulos en el ciclo 1 (DAM) de primero
        ['code' => 'SI', 'name' => 'Sistemas informaticos', 'hours' => 165, 'course' => 1, 'cycle_id' => 1],
        ['code' => 'BBDD', 'name' => 'Bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 1],
        ['code' => 'PROG', 'name' => 'Programación', 'hours' => 264, 'course' => 1, 'cycle_id' => 1],
        ['code' => 'LMSGI', 'name' => 'Lenguajes de marcas y sistemas de gestión informática', 'hours' => 132, 'course' => 1, 'cycle_id' => 1],
        ['code' => 'EDE', 'name' => 'Entornos de desarrollo', 'hours' => 99, 'course' => 1, 'cycle_id' => 1],
        //se insertan 5 módulos en el ciclo 1 (DAM) de segundo
        ['code' => 'ACD', 'name' => 'Acceso a datos', 'hours' => 120, 'course' => 2, 'cycle_id' => 1],
        ['code' => 'DI', 'name' => 'Desarrollo de interfaces', 'hours' => 140, 'course' => 2, 'cycle_id' => 1],
        ['code' => 'PMDM', 'name' => 'Programación multimedia y dispositivos móviles', 'hours' => 100, 'course' => 2, 'cycle_id' => 1],
        ['code' => 'PSP', 'name' => 'Programación de servicios y procesos', 'hours' => 80, 'course' => 2, 'cycle_id' => 1],
        ['code' => 'SGE', 'name' => 'Sistemas de gestión empresarial', 'hours' => 100, 'course' => 2, 'cycle_id' => 1],
    ]);
}
}
