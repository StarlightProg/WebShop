<?php 

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminService{
    
    public function storeProduct(Request $data){
        $cover_path = $this->storeImage($data->file('product-cover'));

        $images_json = [];
        
        if(!is_null($data->file('product-images'))){
            foreach ($data->file('product-images') as $image) {
                $image_path = $this->storeImage($image);
                $images_json[] = $image_path;
            }
        }
        
        Product::firstOrCreate(
            ["cover" => $cover_path,
            "images" => json_encode($images_json),
            "product_name" => $data->{"product-name"},
            "price" => (float) $data->{"product-price"},
            "description" => $data->{"product-description"},
            "size" => $data->{"product-size"},
            "discount" => (int) $data->{"product-discount"},
            "category_id" => (int) $data->{"product-caregory"}
        ]);
    }

    public function storeImage($image){
        $cover = uniqid() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('assets', $cover, 'public');

        $image = Image::make(public_path("storage/{$path}"))->fit(800,1200);
        $image->save();

        return $path;
    }
}