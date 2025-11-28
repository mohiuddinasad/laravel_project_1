<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = new Category();
        $category->title = 'laptop';
        $category->slug = 'laptop';
        $category->save();
    }
}