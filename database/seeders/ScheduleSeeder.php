<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shedules')->insert([

            //Id's de los modulos 2DAM: 6ACD,7DI,8PMDM,9PSP,10SGE
            
            // Koldo -> 10 
            // Ruben -> 11
            // Borja -> 12

            //He utilizado nuestro propio horario
            //El id del profesor me lo he inventado, he escogido 10,11 y 12
            //El id del modulo es el orden en el que se insertan los modulos en el seeder

            //Dia 1
            ['id_teacher' => 10,'id_module' => 6,'day' => 1,'hour' => '1'],
            ['id_teacher' => 10,'id_module' => 6,'day' => 1,'hour' => '2'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 1,'hour' => '3'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 1,'hour' => '4'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 1,'hour' => '5'],

            //Dia 2
            ['id_teacher' => 12,'id_module' => 8,'day' => 2,'hour' => '1'],
            ['id_teacher' => 12,'id_module' => 8,'day' => 2,'hour' => '2'],

            //Dia 3
            ['id_teacher' => 11,'id_module' => 10,'day' => 3,'hour' => '1'],
            ['id_teacher' => 11,'id_module' => 10,'day' => 3,'hour' => '2'],
            ['id_teacher' => 10,'id_module' => 9,'day' => 3,'hour' => '3'],
            ['id_teacher' => 10,'id_module' => 9,'day' => 3,'hour' => '4'],
            ['id_teacher' => 10,'id_module' => 9,'day' => 3,'hour' => '5'],

            //Dia 4
            ['id_teacher' => 11,'id_module' => 10,'day' => 4,'hour' => '1'],
            ['id_teacher' => 11,'id_module' => 10,'day' => 4,'hour' => '2'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 4,'hour' => '3'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 4,'hour' => '4'],
            ['id_teacher' => 11,'id_module' => 7,'day' => 4,'hour' => '5'],

            //Dia 5
            ['id_teacher' => 10,'id_module' => 6,'day' => 5,'hour' => '1'],
            ['id_teacher' => 10,'id_module' => 6,'day' => 5,'hour' => '2'],
            ['id_teacher' => 10,'id_module' => 6,'day' => 5,'hour' => '3'],
            ['id_teacher' => 12,'id_module' => 8,'day' => 5,'hour' => '4'],
            ['id_teacher' => 12,'id_module' => 8,'day' => 5,'hour' => '5'],
         ]);
    }
}
