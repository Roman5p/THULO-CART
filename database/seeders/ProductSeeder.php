<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Pro 15',
                'slug' => 'laptop-pro-15',
                'price' => 1200.99,
                'quantity' => 10,
                'discount_amount' => 100.00,
                'actual_amount' => 1100.99,
                'image' => 'laptop_pro_15.jpg',
                'description' => 'High-performance laptop for professionals.',
                'category_id' => 1,
            ],
            [
                'name' => 'Gaming Mouse',
                'slug' => 'gaming-mouse',
                'price' => 49.99,
                'quantity' => 50,
                'discount_amount' => 5.00,
                'actual_amount' => 44.99,
                'image' => 'gaming_mouse.jpg',
                'description' => 'Ergonomic gaming mouse with customizable buttons.',
                'category_id' => 2,
            ],
            [
                'name' => 'Wireless Keyboard',
                'slug' => 'wireless-keyboard',
                'price' => 79.99,
                'quantity' => 30,
                'discount_amount' => 10.00,
                'actual_amount' => 69.99,
                'image' => 'wireless_keyboard.jpg',
                'description' => 'Sleek and responsive wireless keyboard.',
                'category_id' => 2,
            ],
            [
                'name' => 'Smartphone X',
                'slug' => 'smartphone-x',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
            [
                'name' => 'Noise Cancelling Headphones',
                'slug' => 'noise-cancelling-headphones',
                'price' => 199.99,
                'quantity' => 20,
                'discount_amount' => 20.00,
                'actual_amount' => 179.99,
                'image' => 'headphones.jpg',
                'description' => 'High-quality noise-canceling headphones.',
                'category_id' => 4,
            ],
            [
                'name' => 'Smartphone Y',
                'slug' => 'smartphone-y',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
            [
                'name' => 'Smartphone Z',
                'slug' => 'smartphone-z',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
            [
                'name' => 'Smartphone A',
                'slug' => 'smartphone-a',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
            [
                'name' => 'Smartphone B',
                'slug' => 'smartphone-b',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
            [
                'name' => 'Smartphone C',
                'slug' => 'smartphone-c',
                'price' => 999.99,
                'quantity' => 15,
                'discount_amount' => 50.00,
                'actual_amount' => 949.99,
                'image' => 'smartphone_x.jpg',
                'description' => 'Latest model smartphone with advanced features.',
                'category_id' => 3,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
    }
}

}