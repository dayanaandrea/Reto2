<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('ciclos')->insert([
        ['codigo' => 'ciclo1', 'nombre' => 'Ciclo 1'],
        ['codigo' => 'ciclo2', 'nombre' => 'Ciclo 2'],
        ['codigo' => 'ciclo3', 'nombre' => 'Ciclo 3'],
    ]);
}
}
