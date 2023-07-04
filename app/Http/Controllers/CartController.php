<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
        $goods = $this->cartService->get();

        return view('cart', compact('goods'));
    }

    public function store(Request $request)
    {      
        $productId = $request->id;
        $quantity = $request->quantity;

        Product::findOr($productId, function(){
            return redirect()->back()->with('error', 'Товар не найден');
        });

        if(Auth::check()){
            $this->cartService->authStore($productId, $quantity);
        }
        else{
            $this->cartService->sessionStore($productId, $quantity);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
        
    }
}
