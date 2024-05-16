<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipements = [
            'HP LaserJet Printer',
            'Epson Projector',
            'Dell Desktop Computer',
            'Apple MacBook Pro',
            'Cisco Conference Phone',
            'Keurig Coffee Machine',
            'Whiteboard',
            'Office Desk',
            'Ergonomic Chair',
            'Meeting Room Table',
            'Shared Workspace Desk'
        ];

        foreach ($equipements as $equipement) {
            Equipement::create(['name' => $equipement]);
        }
    }
}
