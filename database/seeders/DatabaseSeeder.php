<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategorySeeder::class,
            EquipementSeeder::class,
            ServiceSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            EspaceSeeder::class,
            ReservationSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
