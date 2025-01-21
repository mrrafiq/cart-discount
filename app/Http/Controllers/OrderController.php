<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDiscount;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $role = $user->getRoleNames()->first();
        // dd($role);
        if ($role != 'admin') {
            $orders = Order::where('user_id', $user->id)->get();
            return view('order.index', ['title' => 'order'])->with('datas', $orders);
        }
        $orders = Order::all();
        return view('order.index', ['title' => 'order'])->with('datas', $orders);
    }

    public function store(Request $request)
    {
        $price_before = $request->price_before;
        $price_after = $request->price_after;

        DB::beginTransaction();

        if ($request->discount_id != null) {
            $check_discount = Discount::find($request->discount_id);
            if (!$check_discount) {
                DB::rollBack();
                Session::flash('error', 'Kode diskon tidak valid');
                return redirect()->back()->withInput();
            }

            // change discount status in cart_discount
            $cart_discount = CartDiscount::where('user_id', Auth::user()->id)->where('status', 'unused')
                            ->update(['status' => 'used']);
            if(!$cart_discount){
                DB::rollBack();
                Session::flash('error', 'Gagal mengupdate Cart Discount');
                return redirect()->back()->withInput();
            }
            
        }

        // change status in cart
        $carts = Cart::where('user_id', Auth::user()->id)->where('status', 'cart')->get();
        foreach ($carts as $cart) {
            $cart->status = 'checkout';
            $cart->save();
        }
        if(!$carts){
            DB::rollBack();
            Session::flash('error', 'Gagal mengupdate Cart');
            return redirect()->back()->withInput();
        }

        try {
            // order code
            $date = date('Ymd');
            $order_code = 'ORDER/'. $date . '-'. Auth::user()->id;

            // input data to orders
            $order = new Order();
            $order->price_before = $price_before;
            $order->price_after = $price_after;
            $order->discount_id = $request->discount_id;
            $order->code = $order_code;
            $order->user_id = Auth::user()->id;
            $order->save();

            // input to order detail
            foreach ($carts as $cart) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order->id;
                $order_detail->cart_id = $cart->id;
                $order_detail->save();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        DB::commit();
        Session::flash('success', 'Pesanan berhasil di order');
        return redirect()->route('order.index');
    }

    public function detail($id){
        $order_detail = OrderDetail::with(['order', 'cart'])->where('order_id', $id)->get();
        // dd($order_detail->cart->product->name);

        return view('order.detail', [
            'title' => 'order',
            'datas' => $order_detail
        ]);
    }
}
