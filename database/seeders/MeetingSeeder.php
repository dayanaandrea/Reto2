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
            ['date' => now()->toDateString(), 'time'=> '15:30:00', 'status'=> 'pending','teacher_id'=> 10,'student_id'=> 25, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'time'=> '09:30:00', 'status'=> 'acept','teacher_id'=> 15,'student_id'=> 30, 'created_at'=>now(),'updated_at'=>now()],
            ['date' => now()->toDateString(), 'time'=> '10:30:00', 'status'=> 'rejected','teacher_id'=> 20,'student_id'=> 50, 'created_at'=>now(),'updated_at'=>now()],
        ]);

    }
}
