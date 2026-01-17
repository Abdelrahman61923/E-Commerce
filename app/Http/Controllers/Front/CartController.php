<?php

namespace App\Http\Controllers\Front;

use App\Enums\CouponType;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('front.cart.index', compact('items'));
    }

    public function add(Request $request)
    {
        Cart::instance('cart')->add($request->id,$request->name,$request->quantity,$request->price)->associate('App\Models\Product');
        return redirect()->back();
    }

    public function increase_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }
    public function decrease_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        return redirect()->back();
    }

    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back();
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        Session::forget('coupon');
        Session::forget('discounts');
        return redirect()->back();
    }

    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;
        if(isset($coupon_code))
        {
            $cartTotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

            $coupon = Coupon::where('code', $coupon_code)
                ->whereDate('expiry_date', '>=', now())
                ->where('cart_value', '<=', $cartTotal)
                ->first();
            if (!$coupon) {
                return redirect()->back()->with('error','Invalid Coupon Code!');
            }
            else {
                Session::put('coupon', [
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'cart_value' => $coupon->cart_value,
                ]);
                $this->calculateDiscount();
                return redirect()->back()->with('success','Coupon has been aplied!');
            }
        }
        else {
            return redirect()->back()->with('error','Invalid Coupon Code');
        }
    }

    public function calculateDiscount()
    {
        $discount = 0;
        if (Session::has('coupon')) {
            $cartSubtotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

            if (Session::get('coupon')['type'] == CouponType::FIXED) {
                $discount = (float) Session::get('coupon')['value'];
            } else {
                $discount = ($cartSubtotal * (float) Session::get('coupon')['value']) / 100;
            }

            $subtotalAfterDiscount = $cartSubtotal - $discount;
            $taxAfterDiscounted = ($subtotalAfterDiscount * config('cart.tax')) / 100;
            $totalAfterDiscount = $subtotalAfterDiscount + $taxAfterDiscounted;

            Session::put('discounts', [
                'discount' => number_format($discount, 2, '.', ''),
                'subtotal' => number_format($subtotalAfterDiscount, 2, '.', ''),
                'tax' => number_format($taxAfterDiscounted, 2, '.', ''),
                'total' => number_format($totalAfterDiscount, 2, '.', ''),
            ]);
        }
    }

    public function remove_coupon_code()
    {
        Session::forget('coupon');
        Session::forget('discounts');
        return redirect()->back()->with('success','Coupon has been removed!');
    }

}
