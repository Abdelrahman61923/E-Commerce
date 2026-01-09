<?php

namespace App\Services\Front;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistService
{
    public function getAll()
    {
        return Cart::instance('wishlist')->content();
    }

    public function add(Request $request)
    {
        return Cart::instance('wishlist')->add($request->id, $request->name, $request->quantity, $request->price)
            ->associate('App\Models\Product');
    }

    public function delete($rowId)
    {
        return Cart::instance('wishlist')->remove($rowId);
    }

    public function empty()
    {
        return Cart::instance('wishlist')->destroy();
    }

    public function move($rowId)
    {
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id, $item->name, $item->qty, $item->price)
            ->associate('App\Models\Product');
    }
}
