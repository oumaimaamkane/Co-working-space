<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Bureau Privee', 'Poste du travail partager', 'Salle de reunion'];

        foreach ($categories as $category) {
            Categories::create(['name' => $category]);
        }
    }
}
