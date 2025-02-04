<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('schedules')->insert([         
            //Dia 1
            ['module_id' => 1, 'day' => 1, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 2, 'day' => 1, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 3, 'day' => 1, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 4, 'day' => 1, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 5, 'day' => 1, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 6, 'day' => 1, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 7, 'day' => 1, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 8, 'day' => 1, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 9, 'day' => 1, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 10, 'day' => 1, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 11, 'day' => 1, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 12, 'day' => 1, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],

            //Dia 2
            ['module_id' => 13, 'day' => 2, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 14, 'day' => 2, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 15, 'day' => 2, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 16, 'day' => 2, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 17, 'day' => 2, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 18, 'day' => 2, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 19, 'day' => 2, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 20, 'day' => 2, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 21, 'day' => 2, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 22, 'day' => 2, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 23, 'day' => 2, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 24, 'day' => 2, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],

            //Dia 3
            ['module_id' => 25, 'day' => 3, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 26, 'day' => 3, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 27, 'day' => 3, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 28, 'day' => 3, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 29, 'day' => 3, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 30, 'day' => 3, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 31, 'day' => 3, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 32, 'day' => 3, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 33, 'day' => 3, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 34, 'day' => 3, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 35, 'day' => 3, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 36, 'day' => 3, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],

            //Dia 4
            ['module_id' => 37, 'day' => 4, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 38, 'day' => 4, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 39, 'day' => 4, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 40, 'day' => 4, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 41, 'day' => 4, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 42, 'day' => 4, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 43, 'day' => 4, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 44, 'day' => 4, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 45, 'day' => 4, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 46, 'day' => 4, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 47, 'day' => 4, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 48, 'day' => 4, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],

            //Dia 5
            ['module_id' => 49, 'day' => 5, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 50, 'day' => 5, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 51, 'day' => 5, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 52, 'day' => 5, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 53, 'day' => 5, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 54, 'day' => 5, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 55, 'day' => 5, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 56, 'day' => 5, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 57, 'day' => 5, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 58, 'day' => 5, 'hour' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 59, 'day' => 5, 'hour' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 60, 'day' => 5, 'hour' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Tutorías y guardias del profesor 16
            ['module_id' => 61, 'day' => 1, 'hour' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 62, 'day' => 5, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
            // Tutorías y guardias del profesor 17
            ['module_id' => 63, 'day' => 3, 'hour' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['module_id' => 64, 'day' => 5, 'hour' => 1, 'created_at' => now(), 'updated_at' => now()],
         ]);
    }
}
