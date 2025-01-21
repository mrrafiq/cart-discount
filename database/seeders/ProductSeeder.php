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
        $product->price = 180000;
        $product->description = 'Product 1 description';
        $product->image = 'product1.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product 2';
        $product->code = 'P002';
        $product->price = 150000;
        $product->description = 'Product 2 description';
        $product->image = 'product2.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product 3';
        $product->code = 'P003';
        $product->price = 300000;
        $product->description = 'Product 3 description';
        $product->image = 'default.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product Task 1';
        $product->code = 'FA4532';
        $product->price = 455000;
        $product->description = 'Product TASK 1 description';
        $product->image = 'product1.jpg';
        $product->save();

        // Create a product
        $product = new \App\Models\Product();
        $product->name = 'Product Task 2';
        $product->code = 'FA3518';
        $product->price = 336000;
        $product->description = 'Product TASK 3 description';
        $product->image = 'product2.jpg';
        $product->save();

        // create a discount
        $discount = new \App\Models\Discount();
        $discount->code = "FA111";
        $discount->name = "Promo 1";
        $discount->percentage = 10;
        $discount->discount_nominal = 0;
        $discount->start_date = "2025-01-21";
        $discount->end_date = "2025-05-21";
        $discount->start_time = "00:00:00";
        $discount->end_time = "00:00:00";
        $discount->day_only = null;
        $discount->min_transaction = null;
        $discount->status = '1';
        $discount->description = 'Discount 1';
        $discount->save();

        // create a discount
        $discount = new \App\Models\Discount();
        $discount->code = "FA222";
        $discount->name = "Promo 2";
        $discount->percentage = 0;
        $discount->discount_nominal = 50000;
        $discount->start_date = "2025-01-21";
        $discount->end_date = "2025-05-21";
        $discount->start_time = "00:00:00";
        $discount->end_time = "00:00:00";
        $discount->day_only = null;
        $discount->min_transaction = 0;
        $discount->status = '1';
        $discount->description = 'Discount 2';
        $discount->save();

        // create a discount
        $discount = new \App\Models\Discount();
        $discount->code = "FA333";
        $discount->name = "Promo 3";
        $discount->percentage = 6;
        $discount->discount_nominal = 0;
        $discount->start_date = "2025-01-21";
        $discount->end_date = "2025-05-21";
        $discount->start_time = "00:00:00";
        $discount->end_time = "00:00:00";
        $discount->day_only = null;
        $discount->min_transaction = 400000;
        $discount->status = '1';
        $discount->description = 'Discount 3';
        $discount->save();

        // create a discount
        $discount = new \App\Models\Discount();
        $discount->code = "FA444";
        $discount->name = "Promo 4";
        $discount->percentage = 5;
        $discount->discount_nominal = 0;
        $discount->start_date = null;
        $discount->end_date = null;
        $discount->start_time = "00:00:00";
        $discount->end_time = "23:00:00";
        $discount->day_only = 2;
        $discount->min_transaction = 400000;
        $discount->status = '1';
        $discount->description = 'Discount 4';
        $discount->save();

    }
}
