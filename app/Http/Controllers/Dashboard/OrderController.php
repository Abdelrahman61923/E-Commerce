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
            'transaction'
        );
        return view('dashboard.orders.order-details', compact('order'));
    }

    public function update_order_status(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:ordered,delivered,canceled'],
        ]);

        $data = [
            'status' => $request->status,
            'delivered_date' => null,
            'canceled_date' => null,
        ];

        if ($request->status == 'delivered') {
            $data['delivered_date'] = now();
        }
        elseif ($request->status == 'canceled') {
            $data['canceled_date'] = now();
        }
        $order->update($data);

        if ($request->status == 'delivered' && $order->transaction) {
            $order->transaction->update([
                'status' => 'approved',
            ]);
        }
        return back()->with('success','Status Changed Successfully!');
    }

}
