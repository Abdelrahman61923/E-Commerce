<?php

namespace App\Http\Controllers\Front;

use Throwable;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        DB::beginTransaction();
        try {
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
            event(new OrderCreated($order));

            DB::commit();

            Cart::instance('cart')->destroy();
            Session::forget('checkout');
            Session::forget('coupon');
            Session::forget('discounts');


        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('order.confirmation', $order);
    }

    public function setAmountforCheckout()
    {
        if (!Cart::instance('cart')->content()->count()) {
            Session::forget('checkout');
            return;
        }

        if (Session::has('coupon')) {
            $discounts = Session::get('discounts');

            Session::put('checkout', [
                'discount' => (float) str_replace(',', '', $discounts['discount']),
                'subtotal' => (float) str_replace(',', '', $discounts['subtotal']),
                'tax'      => (float) str_replace(',', '', $discounts['tax']),
                'total'    => (float) str_replace(',', '', $discounts['total']),
            ]);
        }
        else {
            $subtotal = Cart::instance('cart')->subtotal();
            $tax      = Cart::instance('cart')->tax();
            $total    = Cart::instance('cart')->total();

            Session::put('checkout', [
                'discount' => 0,
                'subtotal' => (float) str_replace(',', '', $subtotal),
                'tax'      => (float) str_replace(',', '', $tax),
                'total'    => (float) str_replace(',', '', $total),
            ]);
        }
    }


    public function order_confirmation(Order $order)
    {
        $order->load('orderItems.product', 'transaction');
        return view('front.order.order-confirmation', compact('order'));
    }

}
