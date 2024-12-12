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
        ['code' => 'ACD', 'name' => 'Acceso a datos', 'hours' => 120, 'course' => 2, 'cycle_id' => 1, 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'DI', 'name' => 'Desarrollo de interfaces', 'hours' => 140, 'course' => 2, 'cycle_id' => 1, 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'PMDM', 'name' => 'Programación multimedia y dispositivos móviles', 'hours' => 100, 'course' => 2, 'cycle_id' => 1, 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'PSP', 'name' => 'Programación de servicios y procesos', 'hours' => 80, 'course' => 2, 'cycle_id' => 1, 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'SGE', 'name' => 'Sistemas de gestión empresarial', 'hours' => 100, 'course' => 2, 'cycle_id' => 1, 'created_at'=>now(),'updated_at'=>now()]
    ]);
}
}
