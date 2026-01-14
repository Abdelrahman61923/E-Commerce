<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $address = Auth::user()->defaultAddress;
        return view('front.order.checkout', compact('address'));
    }
    public function place_an_order(Request $request)
    {
        $address = Auth::user()->defaultAddress;
        if(!$address) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
                'locality' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'landmark' => ['nullable', 'string', 'max:255'],
                'zip' => ['required', 'string', 'max:20'],
            ]);
            $data['country'] = '';
            $data['user_id'] = auth()->id();
            $data['is_default'] = true;
            $address = Address::create($data);
        }
        $this->setAmountforCheckout();

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'subtotal' => Session::get('checkout')['subtotal'],
            'discount' => Session::get('checkout')['discount'],
            'tax' => Session::get('checkout')['tax'],
            'total' => Session::get('checkout')['total'],
            'name' => $address->name,
            'phone' => $address->phone,
            'locality' => $address->locality,
            'address' => $address->address,
            'city' => $address->city,
            'state' => $address->state,
            'country' => $address->country,
            'landmark' => $address->landmark,
            'zip' => $address->zip,
        ]);
        foreach (Cart::instance('cart')->content() as $item) {
            $orderItem = OrderItem::create([
                'product_id' => $item->id,
                'order_id' => $order->id,
                'price' => $item->price,
                'quantity' => $item->qty,
            ]);
        }
        if ($request->mode == 'card') {
            //
        }
        elseif ($request->mode == 'paymob') {
            //
        }
        elseif ($request->mode == 'cod') {
            $transaction = Transaction::create([
                'user_id'=> Auth::user()->id,
                'order_id' => $order->id,
                'status' => 'pending',
                'mode' => $request->mode,
            ]);
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');

        return redirect()->route('order.confirmation', $order);
    }

    public function setAmountforCheckout()
    {
        if(!Cart::instance('cart')->content()->count()) {
            Session::forget('checkout');
            return;
        }
        if (Session::has('coupon')) {
            Session::put('checkout', [
                'discount' => Session::get('discounts')['discount'],
                'subtotal' => Session::get('discounts')['subtotal'],
                'tax' => Session::get('discounts')['tax'],
                'total' => Session::get('discounts')['total'],
            ]);
        }
        else {
            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => Cart::instance('cart')->subtotal(),
                'tax' => Cart::instance('cart')->tax(),
                'total' => Cart::instance('cart')->total(),
            ]);
        }
    }

    public function order_confirmation(Order $order)
    {
        $order->load('orderItems.product', 'transaction');
        return view('front.order.order-confirmation', compact('order'));
    }

}
