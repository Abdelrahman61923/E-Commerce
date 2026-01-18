<?php

namespace App\Services\Front;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Collection;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistService
{
    protected $items;
    public function __construct()
    {
        $this->items = collect([]);
    }
    public function getWishlist():Collection
    {
        if (!$this->items->count()) {
            $this->items = Wishlist::with('product')->get();
        };
        return $this->items;
    }

    public function add(Product $product)
    {
        $item = Wishlist::where('product_id', $product->id)->first();
        if (!$item) {
            return Wishlist::create([
                'cookie_id' => Wishlist::getCookieId(),
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id'=> $product->id,
            ]);
        }
        return $item;
    }

    public function delete(Product $product)
    {
        return Wishlist::where('product_id', $product->id)->delete();
    }

    public function empty()
    {
        return Wishlist::query()->delete();
    }

    public function move(Product $product)
    {
        $item = Wishlist::where('product_id', $product->id)->first();
        $item->delete();
        Cart::instance('cart')->add($product->id, $product->name, 1, $product->price)
            ->associate('App\Models\Product');
    }
}
