<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedule')->insert([
           //Id's de los modulos 2DAM: 6ACD,7DI,8PMDM,9PSP,10SGE
            // Koldo -> 10 
            // Ruben -> 11
            // Borja -> 12

            //He utilizado nuestro propio horario
            //El id del profesor me lo he inventado, he escogido 10,11 y 12
            //El id del modulo es el orden en el que se insertan los modulos en el seeder

            //Dia 1
            ['user_id' => 10,'module_id' => 6,'day' => 1,'hour' => '1', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 6,'day' => 1,'hour' => '2', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 1,'hour' => '3', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 1,'hour' => '4', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 1,'hour' => '5', 'created_at'=>now(),'updated_at'=>now()],

            //Dia 2
            ['user_id' => 12,'module_id' => 8,'day' => 2,'hour' => '1', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 12,'module_id' => 8,'day' => 2,'hour' => '2', 'created_at'=>now(),'updated_at'=>now()],

            //Dia 3
            ['user_id' => 11,'module_id' => 10,'day' => 3,'hour' => '1', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 10,'day' => 3,'hour' => '2', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 9,'day' => 3,'hour' => '3', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 9,'day' => 3,'hour' => '4', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 9,'day' => 3,'hour' => '5', 'created_at'=>now(),'updated_at'=>now()],

            //Dia 4
            ['user_id' => 11,'module_id' => 10,'day' => 4,'hour' => '1', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 10,'day' => 4,'hour' => '2', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 4,'hour' => '3', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 4,'hour' => '4', 'created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 11,'module_id' => 7,'day' => 4,'hour' => '5', 'created_at'=>now(),'updated_at'=>now()],

            //Dia 5
            ['user_id' => 10,'module_id' => 6,'day' => 5,'hour' => '1','created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 6,'day' => 5,'hour' => '2','created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 10,'module_id' => 6,'day' => 5,'hour' => '3','created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 12,'module_id' => 8,'day' => 5,'hour' => '4','created_at'=>now(),'updated_at'=>now()],
            ['user_id' => 12,'module_id' => 8,'day' => 5,'hour' => '5','created_at'=>now(),'updated_at'=>now()],
         ]);
    }
}
