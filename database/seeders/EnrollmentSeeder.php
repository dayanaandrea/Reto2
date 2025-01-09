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
            ['date' => now()->toDateString(), 'user_id' => 60, 'module_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 60, 'module_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 60, 'module_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 60, 'module_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 60, 'module_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            //Usuario que se matricula en SEGUNDO / DAM
            ['date' => now()->toDateString(), 'user_id' => 61, 'module_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 61, 'module_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 61, 'module_id' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 61, 'module_id' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 61, 'module_id' => 10, 'created_at' => now(), 'updated_at' => now()],

            //Usuario que se matricula en PRIMERO / DAW 
            ['date' => now()->toDateString(), 'user_id' => 62, 'module_id' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 62, 'module_id' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 62, 'module_id' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 62, 'module_id' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 62, 'module_id' => 15, 'created_at' => now(), 'updated_at' => now()],
            //Usuario que se matricula en SEGUNDO / DAW
            ['date' => now()->toDateString(), 'user_id' => 63, 'module_id' => 16, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 63, 'module_id' => 17, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 63, 'module_id' => 18, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 63, 'module_id' => 19, 'created_at' => now(), 'updated_at' => now()],

            //Usuario que se matricula en PRIMERO / ASIR 
            ['date' => now()->toDateString(), 'user_id' => 64, 'module_id' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 64, 'module_id' => 21, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 64, 'module_id' => 22, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 64, 'module_id' => 23, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 64, 'module_id' => 24, 'created_at' => now(), 'updated_at' => now()],
            //Usuario que se matricula en SEGUNDO / ASIR
            ['date' => now()->toDateString(), 'user_id' => 65, 'module_id' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 65, 'module_id' => 26, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 65, 'module_id' => 27, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 65, 'module_id' => 28, 'created_at' => now(), 'updated_at' => now()],
            ['date' => now()->toDateString(), 'user_id' => 65, 'module_id' => 29, 'created_at' => now(), 'updated_at' => now()],


        ]);
    }
}
