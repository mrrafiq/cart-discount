<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartDiscountController as CartDiscountController;
use App\Models\CartDiscount;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function store(Request $request, $id): RedirectResponse
    {
        // check if cart is empty
        $check = CartDiscountController::is_cart_discount_empty(Auth::user()->id);
        if ($check === false) {
            Session::flash('error', 'Promo sudah terpasang di keranjang. Batalkan penggunaan diskon terlebih dahulu');
            return redirect()->back();
        }

        $product = Product::find($id);
        if ($product == null) {
            Session::flash('error', 'Produk tak ditemukan');
            return redirect()->back();
        }
        $total_price = $product->price * $request->quantity;

        $check = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->where('status', 'cart')->first();
        if ($check == null) {
            // add new cart
            $cart = new Cart();
            $cart->product_id = $id;
            $cart->user_id = Auth::user()->id;
            $cart->quantity = $request->quantity;
            $cart->total_price = $total_price;
            $cart->status = 'cart';
            $cart->save();
    
            Session::flash('success', 'Produk berhasil ditambahkan ke keranjang');
            return redirect()->back();
        }
        
        // update quantity and total price from existing cart
        $check->quantity = $check->quantity + $request->quantity;
        $check->total_price = $check->total_price + $total_price;
        $check->save();

        Session::flash('success', 'Data di keranjang berhasil diperbaharui');
        return redirect()->back();
    }

    public function index()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 'cart')->get();

        // get discount code
        $cart_discount = CartDiscount::where('user_id', Auth::user()->id)->where('status', 'unused')->first();
        return view('cart.index', ['title' => 'cart', 'cart_discount' => $cart_discount])->with('datas', $carts);
    }

    public function delete($id): RedirectResponse
    {
        $cart = Cart::find($id);
        if ($cart == null) {
            Session::flash('error', 'Data tidak ditemukan');
            return redirect()->back();
        }
        if (CartDiscountController::is_cart_discount_empty(Auth::user()->id == false)) {
            Session::flash('error', 'Promo sudah terpasang di keranjang. Batalkan penggunaan diskon terlebih dahulu');
            return redirect()->back();
        }
        $cart->delete();
        Session::flash('success', 'Data berhasil dihapus');
        return redirect()->back();
    }

    public function add_cart_discount(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    public function adjust_quantity(Request $request, $id): JsonResponse
    {
        $cart = Cart::where('id', $id)->update(['quantity' => $request->quantity]);
        if (!$cart) {
            return response()->json([
                'message' => 'Adjust quantity error',
                'status' => false,
                'data' => null,
            ], 400);
        }

        return response()->json([
            'message' => 'Adjust quantity successful',
            'status' => true,
            'data' => null,
        ], 200);
    }
}
