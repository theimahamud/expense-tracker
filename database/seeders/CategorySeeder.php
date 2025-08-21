<?php

declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Food', 'Transport', 'Shopping', 'Others'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
