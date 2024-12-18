<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assignment')->insert([

              //Profesor id 10
              ['user_id' => 10,'module_id' => 6, 'created_at'=>now(),'updated_at'=>now()],
              ['user_id' => 10,'module_id' => 9, 'created_at'=>now(),'updated_at'=>now()],
              //Profesor id 11
              ['user_id' => 11,'module_id' => 7,'created_at'=>now(),'updated_at'=>now()],
              ['user_id' => 11,'module_id' => 10,'created_at'=>now(),'updated_at'=>now()],
              //Profesor id 12
              ['user_id' => 12,'module_id' => 8, 'created_at'=>now(),'updated_at'=>now() ],

            
        ]);

    }
}