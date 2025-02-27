<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\categories;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Grocery',
                'slug' => Str::slug('Grocery'),
                'description' => 'Fresh groceries including fruits, vegetables, dairy, and pantry staples.',
                'image' => 'categories/grocery.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'description' => 'Latest gadgets, smartphones, laptops, and home appliances.',
                'image' => 'categories/electronics.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Fashion',
                'slug' => Str::slug('Fashion'),
                'description' => 'Trendy clothing, footwear, and accessories for all ages.',
                'image' => 'categories/fashion.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home & Furniture',
                'slug' => Str::slug('Home & Furniture'),
                'description' => 'Furniture, home decor, and essentials for your living space.',
                'image' => 'categories/home-furniture.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Beauty & Personal Care',
                'slug' => Str::slug('Beauty & Personal Care'),
                'description' => 'Skincare, makeup, and personal hygiene products.',
                'image' => 'categories/beauty-personal-care.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sports & Fitness',
                'slug' => Str::slug('Sports & Fitness'),
                'description' => 'Equipment, apparel, and accessories for sports and fitness enthusiasts.',
                'image' => 'categories/sports-fitness.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Books & Stationery',
                'slug' => Str::slug('Books & Stationery'),
                'description' => 'Novels, textbooks, stationery, and office supplies.',
                'image' => 'categories/books-stationery.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Toys & Games',
                'slug' => Str::slug('Toys & Games'),
                'description' => 'Fun toys, board games, and entertainment for kids.',
                'image' => 'categories/toys-games.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health & Wellness',
                'slug' => Str::slug('Health & Wellness'),
                'description' => 'Vitamins, supplements, and wellness products for a healthy life.',
                'image' => 'categories/health-wellness.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jewelry & Watches',
                'slug' => Str::slug('Jewelry & Watches'),
                'description' => 'Elegant jewelry, watches, and fashion accessories.',
                'image' => 'categories/jewelry-watches.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automotive',
                'slug' => Str::slug('Automotive'),
                'description' => 'Car accessories, tools, and automotive parts.',
                'image' => 'categories/automotive.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pet Supplies',
                'slug' => Str::slug('Pet Supplies'),
                'description' => 'Food, toys, and accessories for your pets.',
                'image' => 'categories/pet-supplies.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
