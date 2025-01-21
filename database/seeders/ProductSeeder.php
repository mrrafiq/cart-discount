<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product 1';
        $product->code = 'P001';
        $product->price = 100;
        $product->description = 'Product 1 description';
        $product->image = 'product1.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product 2';
        $product->code = 'P002';
        $product->price = 200;
        $product->description = 'Product 2 description';
        $product->image = 'product2.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product 3';
        $product->code = 'P003';
        $product->price = 300;
        $product->description = 'Product 3 description';
        $product->image = 'product3.jpg';
        $product->save();
    }
}
