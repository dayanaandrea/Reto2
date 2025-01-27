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
        ['name' => 'Inteligencia Artificial', 'date' => now()->toDateString(), 'contact' => 'info@txurdinaga.com', 'description'=>'Curso básico sobre la Inteligencia Artificial.', 'schedule'=>'8:00 AM - 03:00 PM', 'latitude'=>43.2577516, 'longitude'=>-2.9026275, 'created_at'=>now(),'updated_at'=>now()],
    ]);
}
}