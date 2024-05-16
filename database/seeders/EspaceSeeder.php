<?php

namespace Database\Seeders;

use App\Models\Espace;
use Illuminate\Database\Seeder;

class EspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spaces = [
            [
                'description' => 'this is a space description',
                'price' => '200000',
                'status' => 'valable',
                'capacity' => 6,
                'client_categorie' => 'entreprise',
                'category_id' => 1,
                'floor' => 1,
            ],
            [
                'description' => 'this is a space description',
                'price' => '300000',
                'status' => 'valable',
                'capacity' => 6,
                'client_categorie' => 'entreprise',
                'category_id' => 1,
                'floor' => 1,
            ],
            [
                'description' => 'this is a space description',
                'price' => '400000',
                'status' => 'valable',
                'capacity' => 6,
                'client_categorie' => 'entreprise',
                'category_id' => 1,
                'floor' => 1,
            ],

        ];

        foreach ($spaces as $spaces) {
            Espace::create($spaces);
        }
    }
}
