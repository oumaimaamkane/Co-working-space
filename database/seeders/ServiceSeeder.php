<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Unlimited Wifi',
            'Air Conditioning',
            'Cable TV',
            'Restaurant quality',
            'PRIVATE TERACCE',
            'SHOWER',
            'HAIR DRYER',
            'BALCONY'
        ];

        foreach ($services as $service) {
            Service::create(['name' => $service]);
        }
    }
}
