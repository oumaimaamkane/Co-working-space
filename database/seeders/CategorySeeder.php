<?php

namespace Database\Seeders;

<<<<<<< HEAD
<<<<<<< HEAD
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
use App\Models\Category;
>>>>>>> 8132f1a407d9c370700bf9de3b6bbadff68b9b8e
=======

use App\Models\Category;
>>>>>>> aab833e1c066bfefcb915b8f46c5d369bd84470a
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
        //
=======
=======
>>>>>>> aab833e1c066bfefcb915b8f46c5d369bd84470a
        $categories = ['Bureau Privee', 'Poste du travail partager', 'Salle de reunion'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
<<<<<<< HEAD
>>>>>>> 8132f1a407d9c370700bf9de3b6bbadff68b9b8e
=======
>>>>>>> aab833e1c066bfefcb915b8f46c5d369bd84470a
    }
}
