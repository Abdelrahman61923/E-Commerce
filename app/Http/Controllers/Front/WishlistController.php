<?php

namespace App\Http\Controllers\Front;

use App\Services\Front\WishlistService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    public function __construct(protected WishlistService $wishlistService)
    {}
    public function index()
    {
        $items = $this->wishlistService->getAll();
        return view('front.cart.wishlist', compact('items'));
    }

    public function add_to_wishlist(Request $request)
    {
        $this->wishlistService->add($request);
        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        $this->wishlistService->delete($rowId);
        return redirect()->back();
    }

    public function empty_wishlist()
    {
        $this->wishlistService->empty();
        return redirect()->back();
    }

    public function move_to_cart($rowId)
    {
        $this->wishlistService->move($rowId);
        return redirect()->back();
    }
}
