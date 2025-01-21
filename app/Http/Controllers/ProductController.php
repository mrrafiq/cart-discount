<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', ['title' => 'product'])->with('products', $products);
    }

    public function create()
    {
        return view('product.create', ['title' => 'product']);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $request->validate([
                'name' => 'required',
                'code' => 'required',
                'price' => 'required',
                'description' => 'required',
            ]);
            
        } catch (\Throwable $th) {
            throw $th;
        }
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        if ($request->image != null) {
            $imageName = $request->code . '_' . time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;    
            // dd(true);
        }
        $product->save();

        Session::flash('success', 'Product berhasil ditambahkan');
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', ['title' => 'product'])->with('product', $product);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if($product == null) {
            // return back
            Session::flash('error', 'Invalid login credentials');
            return redirect()->back()->with('error', 'Product not found');
        }

        $product->name = $request->name;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->description = $request->description;
        if ($request->image != null) {
            $imageName = $request->code . '_' . time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName;    
            // dd(true);
        }
        $product->save();
        Session::flash('success', 'Product berhasil diperbaharui');
        return redirect()->route('product.index');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if($product == null) {
            // return back
            Session::flash('error', 'Invalid login credentials');
            return redirect()->back()->with('error', 'Product not found');
        }
        $product->delete();
        Session::flash('success', 'Produk berhasil dihapus');
        return redirect()->route('product.index');
    }
}
