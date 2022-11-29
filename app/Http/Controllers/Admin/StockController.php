<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Auth;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = Stock::all();
        return view('backend.pages.stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('backend.pages.stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity'   => 'required',
        ]);

        $data             = $request->except('_token');
        $data['admin_id'] = Auth::guard('admin')->user()->id;
        Stock::create($data);

        $product = Product::where('id', $request->product_id)->first();

        if (!empty($product)) {
            $product->total_quantity     = $product->total_quantity + $request->quantity;
            $product->remaining_quantity = $product->remaining_quantity + $request->quantity;
            $product->save();
        }

        session()->flash('success', 'Stock has been created !!');
        return redirect()->route('admin.stock.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $earning  = Stock::find($id);
        $products = Product::all();
        return view('backend.pages.stock.edit', compact('earning', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $earning = Stock::find($id);

        // Validation Data
        $request->validate([
            'user_email'  => 'required|email',
            'earn_amount' => 'required',
        ]);

        $earning->user_email  = $request->user_email;
        $earning->earn_amount = $request->earn_amount;
        $earning->save();

        session()->flash('success', 'Stock has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $earning = Stock::find($id);
        if (!is_null($earning)) {
            $earning->delete();
        }

        session()->flash('success', 'Stock has been deleted !!');
        return back();
    }
}
