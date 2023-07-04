<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddCart extends Component
{

    public Product $product;
    
    public $quantity = 1;
    
    public function add()
    {

        if (Auth::user() == null) {
            
            return redirect(route('login'));
        }
        
        // vérification que le produit n'est pas déja exsistant 
        $cart = Cart::where('user_id', Auth::user()->id)
                    ->where('product_id', $this->product->id)
                    ->first();

                    if (isset($cart)) {
                        $cart->update([
                            'quantity' => $this->quantity
                        ]);
                    }else{
                        Cart::create([
                            'user_id'=> Auth::user()->id,
                            'product_id'=> $this->product->id,
                            'quantity'=> $this->quantity,
                            'prix'=> $this->product->prix

                        ]);
                    }
    }

    public function goToCart()
    {
        return redirect(route('cart'));
    }

    public function render()
    {
        return view('livewire.add-cart');
    }
}
