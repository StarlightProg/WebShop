<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        if(Auth::check()){
            session()->put('cart.count', count(Cart::where('user_id', Auth::user()->id)->get()));
        }
    }

    public function index(){
        $products = Product::all();

        return view('home',compact('products'));
    }
}
