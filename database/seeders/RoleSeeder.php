<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role' => 'profesor', 'created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'estudiante', 'created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'administrador', 'created_at'=>now(), 'updated_at'=> now()],
            ['role' => 'god', 'created_at'=>now(), 'updated_at'=> now()]
        ]);
    }
}
