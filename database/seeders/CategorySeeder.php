<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Smartphone','created_at' => now()],
            ['name' => 'Tablet','created_at' => now()],
            ['name' => 'Laptop','created_at' => now()],
            ['name' => 'Desktop','created_at' => now()],
        ]);
    }
}
