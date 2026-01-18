<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Services\Front\WishlistService;

class WishlistController extends Controller
{
    public function __construct(protected WishlistService $wishlistService)
    {}
    public function index()
    {
        $items = $this->wishlistService->getWishlist();
        return view('front.cart.wishlist', compact('items'));
    }

    public function add_to_wishlist(Product $product)
    {
        $this->wishlistService->add($product);
        return redirect()->back();
    }

    public function remove_item(Product $product)
    {
        $this->wishlistService->delete($product);
        return redirect()->back();
    }

    public function empty_wishlist()
    {
        $this->wishlistService->empty();
        return redirect()->back();
    }

    public function move_to_cart(Product $product)
    {
        $this->wishlistService->move($product);
        return redirect()->back();
    }
}
