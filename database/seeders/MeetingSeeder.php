<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('meetings')->insert([
            ['day' => 1, 'time' => 1, 'status' => 'pendiente', 'user_id' => 15, 'week' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['day' => 2, 'time' => 1, 'status' => 'aceptada', 'user_id' => 16, 'week' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['day' => 3, 'time' => 2, 'status' => 'rechazada', 'user_id' => 20, 'week' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['day' => 1, 'time' => 6, 'status' => 'pendiente', 'user_id' => 16, 'week' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
