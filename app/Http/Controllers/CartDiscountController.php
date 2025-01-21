<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDiscount;
use App\Models\Discount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartDiscountController extends Controller
{
    

    public function use_discount(Request $request): RedirectResponse
    {
        // jika discount_code kosong
        if ($request->discount_code == null) {
            $this->remove_discount();
        }
        // check discount_id exists
        $discount = Discount::where('code', $request->discount_code)->first();
        if ($discount == null) {
            Session::flash('error', 'Belanja tanpa menggunakan diskon');
            return redirect()->back();
        }

        // check if user already use discount
        $is_used = $this->is_cart_discount_empty(Auth::user()->id);
        // if used, remove discount
        if (!$is_used) {
            $this->remove_discount();
        }

        // validate discount with following discount_id and total price params
        $validate = $this->validate_discount($discount->id, $request->total_price);
        if (!$validate) {
            Session::flash('error', 'Diskon tidak memenuhi persyaratan');
            return redirect()->back();
        }
        
        // get user cart
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 'cart')->get();
        foreach ($carts as $cart) {
            // input data to cart_discounts table
            $cart_discount = new CartDiscount();
            $cart_discount->cart_id = $cart->id;
            $cart_discount->discount_id = $discount->id;
            $cart_discount->user_id = Auth::user()->id;
            $cart_discount->status = 'unused';
            $cart_discount->save();
        }
        
        Session::flash('success', 'Kupon siap digunakan!');
        return redirect()->back();
    }

    public static function is_cart_discount_empty(int $user_id): bool
    {
        // check cart_discount is used or unused
        $cart_discount = CartDiscount::where('user_id', $user_id)->where('status', 'unused')->first();
        if ($cart_discount != null) {
            return false;
        }
        
        return true;
    }

    public function remove_discount(): RedirectResponse
    {
        $cart_discount = CartDiscount::where('user_id', Auth::user()->id)->where('status', 'unused')->get();
        if ($cart_discount != null) {
            foreach ($cart_discount as $cd) {
                $cd->delete();
            }
        }else{
            Session::flash('error', 'Belum ada kode diskon yang digunakan');
            return redirect()->back();
        }

        Session::flash('success', 'Kode diskon batal digunakan');
        return redirect()->back();
    }

    public static function validate_discount(int $discount_id, int $total_price): bool
    {
        $discount = Discount::where('id', $discount_id)->where('status', '1')->first();
        if ($discount == null) {
            return false;
        }

        // check if end_date of discount is expired
        if ($discount->end_date != null && $discount->start_date != null) {
            $end_date = $discount->end_date;
            $start_date = $discount->start_date;
            $current_date = date('Y-m-d');
            if ($current_date > $end_date || $current_date < $start_date) {
                return false;
            }
            // check time
            if (date('h:i:s') < $discount->start_time && date('h:i:s') > $discount->end_time) {
                return false;
            }
        }

        // check if minimum_price is reached
        if ($discount->min_transaction != 0 || $discount->min_transaction != null) {
            if ($total_price < $discount->min_transaction) {
                return false;
            }
        }
        
        // check if today equals day_only
        // day_only = day of week
        if ($discount->day_only != null || $discount->day_only != 0) {
            if (date('N') != $discount->day_only) {
                return false;
            }
            // check time
            if (date('h:i:s') < $discount->start_time && date('h:i:s') > $discount->end_time) {
                return false;
            }
        }

        return true;
    }
}
