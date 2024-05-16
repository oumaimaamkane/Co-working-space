<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
use App\Models\Category;
>>>>>>> 8132f1a407d9c370700bf9de3b6bbadff68b9b8e
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
        //
=======
        $categories = ['Bureau Privee', 'Poste du travail partager', 'Salle de reunion'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
>>>>>>> 8132f1a407d9c370700bf9de3b6bbadff68b9b8e
    }
}
