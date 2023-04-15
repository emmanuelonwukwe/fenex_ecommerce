<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Returns named funtion view page 
     */
    public function adminViewUsersCartView(){
        return view("admin.view-users-cart", ["carts" => $this->index()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Cart::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartView()
    {
        return view("account.cart", ['carts' => $this->index()])
                ->with("cartTotalAmount", $this->cartTotalAmount());
    }

    /**
     * This function gets the cart total amount
     * @return float
     */
    private function cartTotalAmount() {
        $UserCartItems = Cart::where('user_id', auth()->user()->id)->get();

        $totalProductsPrice = 0;
        foreach ($UserCartItems as $key => $cartItem) {
            $totalProductsPrice += $cartItem->product->price * $cartItem->quantity;
        }

        return $totalProductsPrice;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->isUser()) {
            
            $request->validate([
                'product_id' => 'integer'
            ]);

            $cartItem = Cart::where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->first();

            if (!empty($cartItem) AND $cartItem->user_id == auth()->user()->id) {
                //update the quantity of the cart item
                $this->update($request, $cartItem);

                return back()->with("success", "Product ". $cartItem->product->name ." quantity successfully updated on cart");
            }

            //create new cart item
            $newCartItem = Cart::create([
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);

            return back()->with("success", "Product ". $newCartItem->product->name ." successfully added to cart");
       } else {

        return back()->withErrors(["userOnly" => "Admins are not allowed to perform this action"]);
       }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return void
     */
    public function update(Request $request, Cart $cart)
    {
       if ($this->isUser()) {
            $current = $cart->quantity;

            if ($request->intention == 'plus') {
                $dx = $current + 1;
            } else {
                $dx = $current <= 0 ? 0 : $current - 1;
            }

            $cart->update([
                'quantity' => $dx
            ]);
       } else {

        return back()->withErrors(["userOnly" => "Admins are not allowed to perform this action"]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        
        $cart->delete();

        return back()->with("success", $cart->id. 'deleted successfully');
    }

    
}
