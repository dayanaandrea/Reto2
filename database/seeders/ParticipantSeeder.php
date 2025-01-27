<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('participants')->insert([
            ['meeting_id' => 4, 'user_id'=> 15, 'status'=>'pendiente', 'created_at'=>now(),'updated_at'=>now()],
            ['meeting_id' => 4, 'user_id'=> 20, 'status'=>'aceptada', 'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}