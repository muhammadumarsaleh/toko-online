<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
// use alert;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(){
         $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
         if(!empty($order)){
             $orderDetails = OrderDetail::where('order_id', $order->id)->get();
         }else{
            return view('pages.order.checkout', compact('order'));
         }
         return view('pages.order.checkout', compact('order', 'orderDetails'));
    }

    public function delete($id){
        $orderDetail = OrderDetail::where('id', $id)->first();

        $order = Order::where('id', $orderDetail->order_id)->first();
        $order->total_harga = $order->total_harga - $orderDetail->jumlah_harga;
        $order->update();

        $orderDetail->delete();

        return redirect('/checkout');
    }

    public function confirm(){

        $user = User::where('id', Auth::user()->id)->first();

        if(empty($user->alamat))
        {
            // Alert::error('Identitas Harap dilengkapi', 'Error');
            return redirect('profile');
        }

        if(empty($user->nohp))
        {
            // Alert::error('Identitasi Harap dilengkapi', 'Error');
            return redirect('profile');
        }

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order_id = $order->id;
        $order->status = 1;
        $order->update(); 
        
        $orderDetails = OrderDetail::where('order_id', $order_id)->get();
        foreach ($orderDetails as $orderDetail) {
            $product = Product::where('id', $orderDetail->product_id)->first();
            $product->stok = $product->stok-$orderDetail->jumlah;
            $product->update();
        }

        return redirect('/history/.$order_id');

    }
}
