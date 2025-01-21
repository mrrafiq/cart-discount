<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discounts = Discount::all();
        return view('discount.index', ['title' => 'discount'])->with('datas', $discounts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discount.create', ['title' => 'discount']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // request validation
        $isValidated = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'before_or_equal:end_date|after_or_equal:today',
            'end_date' => 'after_or_equal:start_date|after_or_equal:today',
        ]);
        // dd($isValidated);
        if (!$isValidated) {
            Session::flash('error', 'Data yang diinputkan tidak valid');
            return redirect()->back()->withInput()->withErrors($isValidated);
        }

        $discount = new Discount();
        $discount->name = $request->name;
        $discount->code = $request->code;
        $discount->discount_nominal = $request->discount_nominal;
        $discount->percentage = $request->percentage;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->start_time = $request->start_time;
        $discount->end_time = $request->end_time;
        $discount->day_only = $request->day_only;
        $discount->min_transaction = $request->min_transaction;
        $discount->status = $request->status;
        $discount->description = $request->description;
        $discount->save();

        Session::flash('success', 'Diskon berhasil ditambahkan');
        return redirect()->route('discount.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $discount = Discount::find($id);
        // dd($discount);
        return view('discount.edit', ['title' => 'discount'])->with('data', $discount);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // request validation
        $isValidated = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'start_date' => 'before_or_equal:end_date|after_or_equal:today',
            'end_date' => 'after_or_equal:start_date|after_or_equal:today',
        ]);

        if (!$isValidated) {
            Session::flash('error', 'Data yang diinputkan tidak valid');
            return redirect()->back()->withInput();
        }

        // check if start time is greater than end time
        if ($request->start_time > $request->end_time) {
            Session::flash('error', 'Waktu mulai tidak boleh lebih besar dari waktu selesai');
            return redirect()->back()->withInput();
        }

        $discount = Discount::find($id);
        $discount->name = $request->name;
        $discount->code = $request->code;
        $discount->discount_nominal = $request->discount_nominal;
        $discount->percentage = $request->percentage;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->start_time = $request->start_time;
        $discount->end_time = $request->end_time;
        $discount->day_only = $request->day_only;
        $discount->min_transaction = $request->min_transaction;
        $discount->status = $request->status;
        $discount->description = $request->description;
        $discount->save();

        Session::flash('success', 'Diskon berhasil diubah');
        return redirect()->route('discount.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id): RedirectResponse
    {
        $discount = Discount::find($id);
        $discount->delete();
        Session::flash('success', 'Diskon berhasil dihapus');
        return redirect()->route('discount.index');
    }
}
