<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('cycles')->insert([
        ['code' => 'DAM', 'name' => 'Técnico superior en desarrollo de aplicaciones multiplataforma', 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'DAW', 'name' => 'Técnico superior en desarrollo de aplicaciones web', 'created_at'=>now(),'updated_at'=>now()],
        ['code' => 'ASIR', 'name' => 'Técnico superior en administración de sistemas informáticos en red', 'created_at'=>now(),'updated_at'=>now()]
    ]);
}
}