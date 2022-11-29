<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('remaining_quantity', '!=', 0)->get();
        return view('home', compact('products'));
    }

    public function addToCart($id)
    {
        $product = Product::where('id',$id)->first();

        $order = Order::select('order_number')->orderBy('id', 'desc')->first();

        if (!empty($order)) {
            $o  = explode('-', $order->order_number);
            $o2 = str_pad($t[1] + 1, 4, 0, STR_PAD_LEFT);
        } else {
            $o2 = '0001';
        }

        if (!is_null($product)) {

        $data = [
            'user_id' => Auth::guard('web')->user()->id,
            'category_id' => $product->category_id,
            'product_id' => $id,
            'order_number' => 'O-' . $o2,
            'quantity' => 1,
            'price' => $product->price,
        ];
            Order::create($data);

            $product->used_quantity = $product->used_quantity + 1;
            $product->remaining_quantity = $product->remaining_quantity - 1;
            $product->save();
        }

        session()->flash('success', 'Product has been added to cart !!');
        return back();
    }

    public function redirectAdmin()
    {
        return redirect()->route('admin.dashboard');
    }
}
