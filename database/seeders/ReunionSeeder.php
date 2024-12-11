<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReunionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('reuniones')->insert([
            ['fecha' => now()->toDateString(), 'hora'=> '15:30:00', 'estado'=> 'pendiente','id_profesor'=> 10,'id_estudiante'=> 25, 'created_at'=>now(),'updated_at'=>now()],
            ['fecha' => now()->toDateString(), 'hora'=> '09:30:00', 'estado'=> 'aceptada','id_profesor'=> 15,'id_estudiante'=> 30, 'created_at'=>now(),'updated_at'=>now()],
            ['fecha' => now()->toDateString(), 'hora'=> '10:30:00', 'estado'=> 'rechazada','id_profesor'=> 20,'id_estudiante'=> 50, 'created_at'=>now(),'updated_at'=>now()],
        ]);

    }
}
