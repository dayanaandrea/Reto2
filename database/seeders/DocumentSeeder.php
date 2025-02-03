<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('documents')->insert([
        ['name' => '01. Introducción a los Sistemas Informáticos', 'route' => 'm1/d01', 'extension'=>'pdf', 'module_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => '01. Tipos de Datos', 'route' => 'm6/d01', 'extension'=>'pdf', 'module_id'=> 6, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => '03. Consultas SQL', 'route' => 'm12/d03', 'extension'=>'pdf', 'module_id'=> 12, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => '02. Elementos en una Interfaz', 'route' => 'm19/d02', 'extension'=>'pdf', 'module_id'=> 19, 'created_at'=>now(),'updated_at'=>now()],
    ]);
}
}