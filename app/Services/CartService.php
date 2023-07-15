<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartService{

    public function get(){
        if(Auth::check()){
            $goods = Cart::where('user_id', Auth::user()->id)->get();
        }
        else{
            // Session::flush();
            // $goods = session()->put('cart.items', []);
            // $goods = session()->put('cart.count', 0);
            $goods = session()->get('cart.items', []);
        }

        $products = [];

        foreach($goods as $good){
            $products[] = [
                'product' => Product::where('id', $good['product_id'])->first(),
                'quantity' => $good['quantity']
            ];
        }
        
        return $products;
    }

    public function store($product_id, $quantity){
        if(Auth::check()){
            $this->authStore($product_id, $quantity);
        }
        else{
            $this->sessionStore($product_id, $quantity);
        }
    }

    public function delete($product_id){
        if(Auth::check()){
            $this->authDelete($product_id);
        }
        else{
            $this->sessionDelete($product_id);
        }
        //$cartProduct = Cart::where('product_id', $product_name)->where('user_id', Auth::user()->id)->first();
    }

    private function authStore($product_id, $quantity){
        $cartProduct = Cart::where('product_id', $product_id)->where('user_id', Auth::user()->id)->first();

        if(!is_null($cartProduct)){
            $cartProduct->quantity += $quantity;
            $cartProduct->save();
        }
        else{
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'quantity' => $quantity
            ]);
        }
    }

    private function sessionStore($product_id, $quantity){
        $cartItems = session()->get('cart.items', []);
        $quantityExist = array_key_exists($product_id, $cartItems) ? $cartItems[$product_id]['quantity'] : 0;

        $cartItems[$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity + $quantityExist
        ];

        session()->put('cart.count', session()->get('cart.count') + $quantity);
        session()->put('cart.items', $cartItems);
    }

    private function authDelete($product_id){
        $cartProduct = Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->first();

        if(!is_null($cartProduct)){
            $cartProduct->delete();
        }
    }

    private function sessionDelete($product_id){
        $items = session()->get('cart.items', []);
        $quantity = 0;

        foreach ($items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $quantity = $item['quantity'];
                unset($items[$key]);
            }
        }
        
        session()->put('cart.items', $items);
        session()->put('cart.count', session()->get('cart.count') - $quantity);
    }
    
}