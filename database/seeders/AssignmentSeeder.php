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
            /*
            ['id_profesor' => 10,'id_modulo' => 2],
            ['id_profesor' => 5,'id_modulo' => 1],
            ['id_profesor' => 13,'id_modulo' => 3 ]
            */
         ]);
    }
}
