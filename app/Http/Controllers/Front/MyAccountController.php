<?php

namespace App\Http\Controllers\Front;

use App\Enums\OrderStatus;
use App\Events\OrderCanceled;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function index()
    {
        return view('front.account.my-account');
    }
    public function orders()
    {
        $userId = Auth::user()->id;
        $orders = Order::withCount('orderItems')->where('user_id', $userId)->latest()->paginate(10);
        return view('front.account.orders', compact('orders'));
    }

    public function order_details(Order $order)
    {
        $order->load('orderItems.product.category',
            'orderItems.product.brand',
            'transaction'
        );
        return view('front.account.order-details', compact('order'));
    }

    public function update_order_status(Order $order)
    {
        $order->update([
            'status'=> OrderStatus::CANCELED,
            'canceled_date' => now(),
        ]);
        event(new OrderCanceled($order));
        return back()->with('success','Order has been canceled successfully!');
    }

}
