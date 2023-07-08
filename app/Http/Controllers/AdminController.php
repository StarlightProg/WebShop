<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();

        return view('admin',compact('products','categories'));
    }

    public function addProduct(Request $request){

        $filename_cover = uniqid() . '.' . $request->file('product-cover')->getClientOriginalExtension();
        $cover_path = $request->file('product-cover')->storeAs('assets', $filename_cover, 'public');

        $image = Image::make(public_path("storage/{$cover_path}"))->fit(800,1200);
        $image->save();

        $images_json = [];
        
        if(!is_null($request->file('product-images'))){
            foreach ($request->file('product-images') as $image) {
                $filename_image = uniqid() . '.' . $image->getClientOriginalExtension();
                $image_path = $image->storeAs('assets', $filename_image, 'public');

                $image = Image::make(public_path("storage/{$image_path}"))->fit(800,1200);
                $image->save();

                $images_json[] = $image_path;
            }
        }
        
        Product::firstOrCreate(
            ["cover" => $cover_path,
            "images" => json_encode($images_json),
            "product_name" => $request->{"product-name"},
            "price" => (float) $request->{"product-price"},
            "description" => $request->{"product-description"},
            "size" => $request->{"product-size"},
            "discount" => (int) $request->{"product-discount"},
            "category_id" => (int) $request->{"product-caregory"}
        ]);

        return redirect()->route('admin.index')->withInput();   
    }
}
