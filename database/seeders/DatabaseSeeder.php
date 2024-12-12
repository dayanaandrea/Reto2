<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insertar los roles
        $this->call(RoleSeeder::class);
        // Insertar los usuarios
        $this->call(UserSeeder::class);
        $this->call(CycleSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(MeetingSeeder::class);
        $this->call(EnrollmentSeeder::class);

    }
}
