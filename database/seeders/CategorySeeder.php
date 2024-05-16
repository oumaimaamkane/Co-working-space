<?php

namespace Database\Seeders;


use App\Models\Category;
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
            Category::create(['name' => $category]);
        }
    }
}
