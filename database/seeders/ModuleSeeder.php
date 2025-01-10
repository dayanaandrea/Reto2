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
            ['user_id' => null, 'code' => 'SI', 'name' => 'Sistemas informaticos', 'hours' => 165, 'course' => 1, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'BBDD', 'name' => 'Bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'PROG', 'name' => 'Programación', 'hours' => 264, 'course' => 1, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'LMSGI', 'name' => 'Lenguajes de marcas y sistemas de gestión informática', 'hours' => 132, 'course' => 1, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'EDE', 'name' => 'Entornos de desarrollo', 'hours' => 99, 'course' => 1, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            //se insertan 5 módulos en el ciclo 1 (DAM) de segundo
            //Id's de los modulos 2DAM: 6ACD,7DI,8PMDM,9PSP,10SGE
            // Koldo -> 10 
            // Ruben -> 11
            // Borja -> 12E
            ['user_id'=> 10, 'code' => 'ACD', 'name' => 'Acceso a datos', 'hours' => 120, 'course' => 2, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id'=> 11, 'code' => 'DI', 'name' => 'Desarrollo de interfaces', 'hours' => 140, 'course' => 2, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id'=> 12, 'code' => 'PMDM', 'name' => 'Programación multimedia y dispositivos móviles', 'hours' => 100, 'course' => 2, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id'=> 10, 'code' => 'PSP', 'name' => 'Programación de servicios y procesos', 'hours' => 80, 'course' => 2, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id'=> 11, 'code' => 'SGE', 'name' => 'Sistemas de gestión empresarial', 'hours' => 100, 'course' => 2, 'cycle_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            //se insertan 5 módulos en el ciclo 2 (DAW) de primero
            ['user_id' => null, 'code' => 'SIW', 'name' => 'Sistemas informaticos', 'hours' => 165, 'course' => 1, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'BBDDW', 'name' => 'Bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'PROGW', 'name' => 'Programación', 'hours' => 264, 'course' => 1, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'LMSGIW', 'name' => 'Lenguajes de marcas y sistemas de gestión informática', 'hours' => 132, 'course' => 1, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'EDEW', 'name' => 'Entornos de desarrollo', 'hours' => 99, 'course' => 1, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            //se insertan 5 módulos en el ciclo 2 (DAW) de segundo
            ['user_id' => null, 'code' => 'DWEC', 'name' => 'Desarrollo web en entorno cliente', 'hours' => 140, 'course' => 2, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'DWES', 'name' => 'Desarrollo web en entorno servidor', 'hours' => 180, 'course' => 2, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'DAW', 'name' => 'Despliegue de aplicaciones web', 'hours' => 100, 'course' => 2, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'DIW', 'name' => 'Diseño de interfaces web', 'hours' => 120, 'course' => 2, 'cycle_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            //se insertan 5 módulos en el ciclo 3 (ASIR) de primero
            ['user_id' => null, 'code' => 'ISO', 'name' => 'Implantación de sistemas operativos', 'hours' => 264, 'course' => 1, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'PAR', 'name' => 'Planificación y administración de redes', 'hours' => 198, 'course' => 1, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'FDH', 'name' => 'Fundamentos de hardware', 'hours' => 99, 'course' => 1, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'GBD', 'name' => 'Gestión de bases de datos', 'hours' => 198, 'course' => 1, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'LMSGIA', 'name' => 'Lenguajes de marcas y sistemas de gestión de información', 'hours' => 132, 'course' => 1, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            //se insertan 5 módulos en el ciclo 3 (ASIR) de segundo
            ['user_id' => null, 'code' => 'ASO', 'name' => 'Administración de sistemas operativos	', 'hours' => 120, 'course' => 2, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'SRI', 'name' => 'Servicios de red e internet', 'hours' => 120, 'course' => 2, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'IAW', 'name' => 'Implantación de aplicaciones web', 'hours' => 100, 'course' => 2, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'ASGBD', 'name' => 'Administración de sistemas gestores de bases de datos', 'hours' => 60, 'course' => 2, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => null, 'code' => 'SAD', 'name' => 'Seguridad y alta disponibilidad', 'hours' => 100, 'course' => 2, 'cycle_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

