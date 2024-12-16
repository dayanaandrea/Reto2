<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assignment')->insert([

            //Id's de los modulos 2DAM: 6ACD,7DI,8PMDM,9PSP,10SGE
            
            //Profesor id 10
            ['id_teacher' => 10,'id_modulo' => 6],
            ['id_teacher' => 10,'id_modulo' => 9],
            //Profesor id 11
            ['id_teacher' => 11,'id_modulo' => 7],
            ['id_teacher' => 11,'id_modulo' => 10],
            //Profesor id 12
            ['id_teacher' => 12,'id_modulo' => 8 ],
         ]);
    }
}
