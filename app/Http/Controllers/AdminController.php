<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();

        return view('admin',compact('products','categories'));
    }

    public function addProduct(Request $request){
            // $validator = Validator::make($request->all(), [
            //     'cover' => 'image|max:16384',
            //     'images' => 'image|max:32768',
            // ]);

            // if($validator->fails()) {
            //     return response()->json(['error' => 'Invalid file format'], 422);
            // }
        $filename_cover = uniqid() . '.' . $request->file('product-cover')->getClientOriginalExtension();
        $request->file('product-cover')->move(public_path('assets/images'), $filename_cover);

        $images_json = [];
    
        foreach ($request->file('product-images') as $image) {
            $filename_image = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $filename_image);
            $images_json[] = $filename_image;
        }
        
        Product::firstOrCreate(
            ["cover" => $filename_cover,
            "images" => json_encode($images_json),
            "product_name" => $request->{"product-name"},
            "price" => (float) $request->{"product-price"},
            "description" => $request->{"product-description"},
            "size" => $request->{"product-size"},
            "discount" => (int) $request->{"product-discount"},
            "discount_price" =>(float) $request->{"product-discount-price"},
            "category_id" => (int) $request->{"product-caregory"}
        ]);

        return redirect()->route('admin.index')->withInput();   
    }
}
