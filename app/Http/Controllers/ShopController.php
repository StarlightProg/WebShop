<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request){
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $products = Product::where('category_id', $categoryId)->get();
        } else {
            $products = Product::all();
        }

        $categories = Category::all();

        return view('shop',compact('products', 'categories', 'categoryId'));
    }

    public function show($product_name){
        $product = Product::where('product_name', $product_name)->firstOrFail();
        
        return view('product-single',compact('product'));
    }

    public function sort($product_category){
        // $category_id = Category::where('category_name', $product_category)->first()->id;
        // $products = Product::where('category_id', $category_id);

        // return "123";
    }
}
