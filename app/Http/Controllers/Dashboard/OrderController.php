<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Services\Dashboard\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {}
    public function index()
    {
        $orders = $this->orderService->getAll(8);
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderItems.product.category',
            'orderItems.product.brand',
            'user.defaultAddress',
            'transaction'
        );
        return view('dashboard.orders.order-details', compact('order'));
    }
}
