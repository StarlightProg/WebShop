<?php

namespace App\View\Components;

use Closure;
use App\Models\Cart;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $count = 0;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        if(Auth::check()){
            foreach (Cart::where('user_id', Auth::user()->id)->get() as $good) {
                $this->count += $good->quantity;
            }
        }
        else{
            $this->count = session()->get('cart.count', 0);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-count');
    }
}
