<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($id){
        $product = Product::where('id', $id)->first();

        return view('pages.order.index', [
            'product' => $product
        ]);
    }

    public function pesan(Request $request, $id){
        $product = Product::where('id', $id)->first();
        $tanggal = Carbon::now();

        // validasi apakah melebihi stok
        if($request->jumlah_pesan > $product->stok)
        {
            return redirect('order/'.$id);
        }

        // cek validasi
        $cek_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(empty($cek_order))
        {
            // simpan ke database pesanan
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->tanggal = $tanggal;
            $order->status = 0;
            $order->total_harga = 0;
            $order->kode = mt_rand(100, 999);
            $order->save();
        }

        // simpan ke database pesanan detail
        $new_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // cek order detail
        $cek_order_details = OrderDetail::where('product_id', $product->id)->where('order_id', $new_order->id)->first();

        if(empty($cek_order_details))
        {
            $order_details = new OrderDetail;
            $order_details->product_id = $product->id;
            $order_details->order_id = $new_order->id;
            $order_details->jumlah = $request->jumlah_pesan;
            $order_details->jumlah_harga = $product->harga*$request->jumlah_pesan;
            $order_details->save();
        }else{
            $order_details = OrderDetail::where('product_id', $product->id)->where('order_id', $new_order->id)->first();
            $order_details->jumlah = $order_details->jumlah+$request->jumlah_pesan;
            
            // harga sekarang
            $harga_order_details_baru = $product->harga*$request->jumlah_pesan;
            $order_details->jumlah_harga = $order_details->jumlah_harga + $harga_order_details_baru;
            $order_details->update();

        }


        // jumlah total
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order->total_harga = $order->total_harga + $product->harga * $request->jumlah_pesan;
        $order->update();

        

        return redirect('checkout');

    }
}
