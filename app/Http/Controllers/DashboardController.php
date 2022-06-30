<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::paginate(20);
        return view('pages.dashboard', [
            'products' => $products
        ]);
    }

}
