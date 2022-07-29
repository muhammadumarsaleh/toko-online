<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '!=',0)->get();

        return view('pages.history.index', [
            'orders' => $orders
        ]);
    }

    public function detail($id){

        $order = Order::where('id', $id)->first();
        $orderDetails = OrderDetail::where('order_id', $order->id)->get();
        
        return view('pages.history.detail', compact('order', 'orderDetails'));
    }
}
