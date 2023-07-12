<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index(){
        $products = Product::all();
        $categories = Category::all();

        return view('admin',compact('products','categories'));
    }

    public function addProduct(Request $request){      
        $this->adminService->storeProduct($request);

        return redirect()->route('admin.index')->withInput();   
    }
}
