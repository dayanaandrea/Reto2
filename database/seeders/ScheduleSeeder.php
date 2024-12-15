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
        DB::table('horarios')->insert([
            /*
            ['id_profesor' => 10,'id_modulo','dia' => 1,'hora' => '15:00:00'],
            ['id_profesor' => 5,'id_modulo','dia' => 1,'hora' => '17:00:00'],
            ['id_profesor' => 13,'id_modulo','dia' => 3,'hora' => '15:00:00'],
            ['id_profesor' => 13,'id_modulo','dia' => 2,'hora' => '19:00:00']
            ['id_profesor' => 15,'id_modulo','dia' => 4,'hora' => '18:00:00']
            */
         ]);
    }
}
