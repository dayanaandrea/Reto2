<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('ofertas')->insert([
            ['id_ciclo' => 1, 'id_modulo' => 1],
            ['id_ciclo' => 1, 'id_modulo' => 2],
            ['id_ciclo' => 2, 'id_modulo' => 3],
        ]);
    }
}
