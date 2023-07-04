<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService{

    public function get(){
        if(Auth::check()){
            $goods = Cart::where('user_id', Auth::user()->id)->get();
        }
        else{
            $goods = session()->get('cart.items', []);
        }

        foreach($goods as $good){
            $products[] = [
                'product' => Product::where('id', $good['product_id'])->first(),
                'quantity' => $good['quantity']
            ];
        }
        
        return $products;
    }

    public function authStore($productId, $quantity){
        $cartProduct = Cart::where('product_id', $productId)->where('user_id', Auth::user()->id)->first();

        if(!is_null($cartProduct)){
            $cartProduct->quantity += $quantity;
            $cartProduct->save();
        }
        else{
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
    }

    public function sessionStore($productId, $quantity){
        $cartItems = session()->get('cart.items', []);
        $quantityExist = array_key_exists($productId, $cartItems) ? $cartItems[$productId]['quantity'] : 0;

        $cartItems[$productId] = [
            'product_id' => $productId,
            'quantity' => $quantity + $quantityExist
        ];

        session()->put('cart.count', session()->get('cart.count') + $quantity);
        session()->put('cart.items', $cartItems);
    }
}