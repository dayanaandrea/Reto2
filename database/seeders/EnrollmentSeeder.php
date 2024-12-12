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
        DB::table('enrollments')->insert([
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 1,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 50,'module_id'=> 2,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 70,'module_id'=> 3,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
        ]);

    }
}
