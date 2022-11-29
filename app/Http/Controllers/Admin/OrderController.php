<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.pages.orders.index', compact('orders'));
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!is_null($order)) {
            $order->delete();
        }

        session()->flash('success', 'Order has been deleted !!');
        return back();
    }
}
