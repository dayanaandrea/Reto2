<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CicloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('ciclos')->insert([
        ['codigo' => 'DAM', 'nombre' => 'Técnico superior en desarrollo de aplicaciones multiplataforma'],
        ['codigo' => 'DAW', 'nombre' => 'Técnico superior en desarrollo de aplicaciones web'],
        ['codigo' => 'ASIR', 'nombre' => 'Técnico superior en administración de sistemas informáticos en red']
    ]);
}
}
