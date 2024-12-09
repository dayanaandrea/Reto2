<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('matriculas')->insert([
            ['fecha' => now()->toDateString(), 'curso'=> 1, 'id_estudiante'=> 60,'id_modulo'=> 1,'id_ciclo'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['fecha' => now()->toDateString(), 'curso'=> 2, 'id_estudiante'=> 50,'id_modulo'=> 2,'id_ciclo'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['fecha' => now()->toDateString(), 'curso'=> 2, 'id_estudiante'=> 70,'id_modulo'=> 3,'id_ciclo'=> 2, 'created_at'=>now(),'updated_at'=>now()],
        ]);

    }
}
