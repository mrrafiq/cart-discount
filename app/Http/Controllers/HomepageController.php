<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome', ['title' => 'welcome'])->with('datas', $products);
    }

    public function detail($id)
    {
        $product = Product::find($id);
        return view('product.detail', ['title' => 'product detail'])->with('data', $product);
    }
}
