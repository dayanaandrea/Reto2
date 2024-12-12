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

        //se insertan 5 módulos en el ciclo 2 (DAW) de primero
        ['code' => 'SIW', 'name' => 'Sistemas informaticos', 'hours' => 165, 'course' => 1, 'cycle_id' => 2],
        ['code' => 'BBDDW', 'name' => 'Bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 2],
        ['code' => 'PROGW', 'name' => 'Programación', 'hours' => 264, 'course' => 1, 'cycle_id' => 2],
        ['code' => 'LMSGIW', 'name' => 'Lenguajes de marcas y sistemas de gestión informática', 'hours' => 132, 'course' => 1, 'cycle_id' => 2],
        ['code' => 'EDEW', 'name' => 'Entornos de desarrollo', 'hours' => 99, 'course' => 1, 'cycle_id' => 2],
        //se insertan 5 módulos en el ciclo 2 (DAW) de segundo
        ['code' => 'DWEC', 'name' => 'Desarrollo web en entorno cliente', 'hours' => 140, 'course' => 2, 'cycle_id' => 2],
        ['code' => 'DWES', 'name' => 'Desarrollo web en entorno servidor', 'hours' => 180, 'course' => 2, 'cycle_id' => 2],
        ['code' => 'DAW', 'name' => 'Despliegue de aplicaciones web', 'hours' => 100, 'course' => 2, 'cycle_id' => 2],
        ['code' => 'DIW', 'name' => 'Diseño de interfaces web', 'hours' => 120, 'course' => 2, 'cycle_id' => 2],

        //se insertan 5 módulos en el ciclo 3 (ASIR) de primero
        ['code' => 'ISO', 'name' => 'Implantación de sistemas operativos', 'hours' => 264, 'course' => 1, 'cycle_id' => 3],
        ['code' => 'PAR', 'name' => 'Planificación y administración de redes', 'hours' => 198, 'course' => 1, 'cycle_id' => 3],
        ['code' => 'FDH', 'name' => 'Fundamentos de hardware', 'hours' => 99, 'course' => 1, 'cycle_id' => 3],
        ['code' => 'GBD', 'name' => 'Gestión de bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 3],
        ['code' => 'LMSGIA', 'name' => 'Lenguajes de marcas y sistemas de gestión de información', 'hours' => 132, 'course' => 1, 'cycle_id' => 3],
        //se insertan 5 módulos en el ciclo 3 (ASIR) de segundo
        ['code' => 'ASO', 'name' => 'Administración de sistemas operativos	', 'hours' => 120, 'course' => 2, 'cycle_id' => 3],
        ['code' => 'SRI', 'name' => 'Servicios de red e internet', 'hours' => 120, 'course' => 2, 'cycle_id' => 3],
        ['code' => 'IAW', 'name' => 'Implantación de aplicaciones web', 'hours' => 100, 'course' => 2, 'cycle_id' => 3],
        ['code' => 'ASGBD', 'name' => 'Administración de sistemas gestores de bases de datos', 'hours' => 60, 'course' => 2, 'cycle_id' => 3],
        ['code' => 'SAD', 'name' => 'Seguridad y alta disponibilidad', 'hours' => 100, 'course' => 2, 'cycle_id' => 3],
    ]);
}
}

