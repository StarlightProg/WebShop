<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CheckoutController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(){
        $goods = $this->cartService->get();

        return view('checkout', compact('goods'));
    }

    public function store(Request $request){  
        $goods = $this->cartService->get();  
        $metadata = [];
        $totalPrice = 0;
        $totalQuantity = 0;
        
        foreach ($goods as $good) {
            $metadata[] = "{$good['product']['product_name']}, {$good['quantity']}";
            $totalPrice += $good['product']['price'] * $good['quantity'];
            $totalQuantity += $good['quantity'];
        }

        $request->user()->charge(
            $totalPrice * 100, $request->paymentId, [
                'metadata' => [
                    'products' => json_encode($metadata),
                    'total_price' => $totalPrice,
                    'total_quantity' => $totalQuantity
                ],
            ]
        );

        return redirect()->route('home');
    }
}
