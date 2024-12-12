<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('enrollments')->insert([

            //Usuario que se matricula en segundo 
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 60,'module_id'=> 1,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 60,'module_id'=> 2,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 60,'module_id'=> 3,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 60,'module_id'=> 4,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 60,'module_id'=> 5,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            //Usuario que se matricula en segundo 
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 40,'module_id'=> 1,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 40,'module_id'=> 2,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 40,'module_id'=> 3,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 40,'module_id'=> 4,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 40,'module_id'=> 5,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            
        ]);

    }
}
