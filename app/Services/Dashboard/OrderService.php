<?php

namespace App\Services\Dashboard;

use App\Models\Order;

class OrderService
{
    public function getAll($perPage = 10)
    {
        return Order::withCount('orderItems')->latest()->paginate($perPage);
    }
}
