<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();

        return view('shop',compact('products','categories'));
    }

    public function show($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        
        return view('product-single',compact('product'));
    }
}
