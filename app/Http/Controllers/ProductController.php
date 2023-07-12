<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        
        return view('product-single',compact('product'));
    }
}
