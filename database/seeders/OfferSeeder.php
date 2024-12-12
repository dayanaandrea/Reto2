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
            ['cycle_id' => 1, 'module_id' => 1, 'created_at'=>now(),'updated_at'=>now()],
            ['cycle_id' => 1, 'module_id' => 2, 'created_at'=>now(),'updated_at'=>now()],
            ['cycle_id' => 1, 'module_id' => 3, 'created_at'=>now(),'updated_at'=>now()],
            ['cycle_id' => 1, 'module_id' => 4, 'created_at'=>now(),'updated_at'=>now()],
            ['cycle_id' => 1, 'module_id' => 5, 'created_at'=>now(),'updated_at'=>now()]
        ]);
    }
}
