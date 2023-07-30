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

        return view('admin.index',compact('products','categories'));
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('admin.edit', compact('product','categories'));
    }

    public function update(Request $request, int $id)
    {
        $this->adminService->update($request, $id);

        return redirect()->route('admin.index')->withInput();
    }

    public function addProduct(Request $request){      
        $this->adminService->storeProduct($request);

        return redirect()->route('admin.index')->withInput();   
    }

    public function delete($product_id){
        $this->adminService->delete($product_id);

        return redirect()->back()->with('success', 'Товар удалён');
    }
}
