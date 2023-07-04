<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    private function calculTotal($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $cart) {
            $total += ($cart->quantity * $cart->product->prix);
        }

        return $total;
    }



    public function index()
    {
        $cartItems = Cart::where("user_id", Auth::user()->id)->get();

        $total = $this->calculTotal($cartItems);

        return view('cart', compact('cartItems', 'total'));
    }



    // supprime une ranger du pannier
    public function deleteOne(Cart $cart)
    {
        $cart->delete();

        return redirect(route('cart'));
    }

    public function delete()
    {
        Cart::where('user_id', Auth::user()->id)
            ->delete();

            return redirect(route('cart'));
    }

    // public function Update(Cart $cart, Request $request)
    // {
    //     $cart->update(['quantity'=> $request->quantity]); MAJ de la quantité en base

    //     return response()->json(['result'=>true]); 
    // }
    
    public function Update(Cart $cart, $quantity = 1)
    {
        $cart->update(['quantity'=> $quantity]); //MAJ de la quantité en base

        $cartItems = Cart::where("user_id", Auth::user()->id)->get();
        
        $total = $this->calculTotal($cartItems);

        return response()->json(['result'=>true, 
                                'total'=>$total ]); // 
    }
}
