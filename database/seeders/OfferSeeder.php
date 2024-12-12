<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('offers')->insert([
            ['cycle_id' => 1, 'module_id' => 1],
            ['cycle_id' => 1, 'module_id' => 2],
            ['cycle_id' => 1, 'module_id' => 3],
            ['cycle_id' => 1, 'module_id' => 4],
            ['cycle_id' => 1, 'module_id' => 5]
        ]);
    }
}
