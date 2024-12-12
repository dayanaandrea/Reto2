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

            //Usuario que se matricula en PRIMERO / DAM   
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 1,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 2,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 3,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 4,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 60,'module_id'=> 5,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            //Usuario que se matricula en SEGUNDO / DAM
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 61,'module_id'=> 6,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 61,'module_id'=> 7,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 61,'module_id'=> 8,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 61,'module_id'=> 9,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 61,'module_id'=> 10,'cycle_id'=> 1, 'created_at'=>now(),'updated_at'=>now()],
            
            //Usuario que se matricula en PRIMERO / DAW 
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 62,'module_id'=> 11,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 62,'module_id'=> 12,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 62,'module_id'=> 13,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 62,'module_id'=> 14,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 62,'module_id'=> 15,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            //Usuario que se matricula en SEGUNDO / DAW
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 63,'module_id'=> 16,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 63,'module_id'=> 17,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 63,'module_id'=> 18,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 63,'module_id'=> 19,'cycle_id'=> 2, 'created_at'=>now(),'updated_at'=>now()],

            //Usuario que se matricula en PRIMERO / ASIR 
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 64,'module_id'=> 20,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 64,'module_id'=> 21,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 64,'module_id'=> 22,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 64,'module_id'=> 23,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 1, 'student_id'=> 64,'module_id'=> 24,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            //Usuario que se matricula en SEGUNDO / ASIR
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 65,'module_id'=> 25,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 65,'module_id'=> 26,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 65,'module_id'=> 27,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 65,'module_id'=> 28,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'course'=> 2, 'student_id'=> 65,'module_id'=> 29,'cycle_id'=> 3, 'created_at'=>now(),'updated_at'=>now()],
            
        ]);

    }
}
