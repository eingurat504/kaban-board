<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            'To Do', 
            'In Progress', 
            'Done'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
