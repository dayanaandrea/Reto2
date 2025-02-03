<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('courses')->insert([
        ['name' => 'Inteligencia Artificial', 'date' => now()->toDateString(), 'contact' => 'info@txurdinaga.com', 'description'=>'Curso básico sobre la Inteligencia Artificial.', 'schedule'=>'08:00 - 15:00 ', 'latitude'=>43.2577516, 'longitude'=>-2.9026275, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => 'Sistemas microinformáticos', 'date' => now()->toDateString(), 'contact' => 'prevencion@urko.net', 'description'=>' Instalación y configuración de sistemas operativos.', 'schedule'=>'09:30 - 14:30', 'latitude'=>43.317553677483204, 'longitude'=>-1.971155716350483, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => 'Desarrollo web para comercio electrónico', 'date' => now()->toDateString(), 'contact' => 'prevencion@urko.net', 'description'=>'Curso básico sobre desarrollo web para comercio electrónico.', 'schedule'=>' 15:30 - 19:30', 'latitude'=>43.19011414955793, 'longitude'=>-2.4511177893686162, 'created_at'=>now(),'updated_at'=>now()],
        ['name' => 'Presentación de proyectos de edificación ', 'date' => now()->toDateString(), 'contact' => '014205aa@hezkuntza.net', 'description'=>' Curso básico de presentación de proyectos de edificación.', 'schedule'=>'17:30 - 20:45', 'latitude'=> 43.255190165918926, 'longitude'=>-2.92172740101083 , 'created_at'=>now(),'updated_at'=>now()],
        ['name' => 'Gestión de comunidades virtuales', 'date' => now()->toDateString(), 'contact' => 'san_prudencio@autoescuelasanprudencio.com', 'description'=>'Curso básico sobre gestión de comunidades virtuales.', 'schedule'=>'09:00 - 13:00', 'latitude'=>42.851220279012786, 'longitude'=>-2.66684135869761, 'created_at'=>now(),'updated_at'=>now()],
    
    ]);
}
}