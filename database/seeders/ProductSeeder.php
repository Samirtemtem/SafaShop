<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Wine Glass',
                'subtitle' => 'Set of 2 | Clear',
                'description' => 'Elegant wine glasses perfect for your dining table',
                'price' => 50.00,
                'image' => 'https://images.unsplash.com/photo-1549438159-024f0ccd2361?w=200',
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Champagne Saucer',
                'subtitle' => 'Set of 2 | Clear',
                'description' => 'Classic champagne saucers for special occasions',
                'price' => 45.00,
                'image' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=200',
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Dinner Plate Set',
                'subtitle' => 'Set of 4 | White',
                'description' => 'Modern dinner plates for everyday dining',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1603199506016-b9a594b593c0?w=200',
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Crystal Decanter',
                'subtitle' => 'Single | Clear',
                'description' => 'Luxurious crystal decanter for wine enthusiasts',
                'price' => 75.50,
                'image' => 'https://images.unsplash.com/photo-1578500494198-246f612d3b3d?w=200',
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Gold Cutlery Set',
                'subtitle' => 'Set of 16 | Gold',
                'description' => 'Premium gold-plated cutlery for elegant dining',
                'price' => 159.99,
                'image' => 'https://images.unsplash.com/photo-1595864259583-67562151915e?w=200',
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
