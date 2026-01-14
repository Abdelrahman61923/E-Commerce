<?php

namespace App\Services\Dashboard;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getAll()
    {
        return Order::withCount('orderItems')->latest()->take(10)->get();
    }
    public function getDashboardStats()
    {
        $orders = Order::all();
        return [
            'total_orders' => $orders->count(),
            'total_amount' => $orders->sum('total'),
            'delivered_orders' => $orders->where('status', Order::STATUS_DELIVERED)->count(),
            'delivered_amount' => $orders->where('status', Order::STATUS_DELIVERED)->sum('total'),
            'pending_orders' => $orders->where('status', Order::STATUS_ORDERED)->count(),
            'pending_amount' => $orders->where('status', Order::STATUS_ORDERED)->sum('total'),
            'canceled_orders' => $orders->where('status', Order::STATUS_CANCELED)->count(),
            'canceled_amount' => $orders->where('status', Order::STATUS_CANCELED)->sum('total'),
        ];
    }

    public function getMonthlyStats($year = null)
    {
        $year = $year ?? now()->year;
        $orders = Order::whereYear('created_at', $year)
            ->selectRaw('
                MONTH(created_at) as month_no,
                SUM(total) as total_amount,
                SUM(CASE WHEN status = ? THEN total ELSE 0 END) as ordered_amount,
                SUM(CASE WHEN status = ? THEN total ELSE 0 END) as delivered_amount,
                SUM(CASE WHEN status = ? THEN total ELSE 0 END) as canceled_amount
            ', [
                Order::STATUS_ORDERED,
                Order::STATUS_DELIVERED,
                Order::STATUS_CANCELED,
            ])
            ->groupByRaw('MONTH(created_at)')
            ->get()
            ->keyBy('month_no');

        return collect(range(1, 12))->map(function ($month) use ($orders) {
            $date = Carbon::createFromDate(null, $month, 1);

            return (object) [
                'MonthNo' => $month,
                'MonthName' => $date->format('M'),
                'TotalAmount' => $orders[$month]->total_amount ?? 0,
                'TotalOrderedAmount' => $orders[$month]->ordered_amount ?? 0,
                'TotalDeliveredAmount' => $orders[$month]->delivered_amount ?? 0,
                'TotalCanceledAmount' => $orders[$month]->canceled_amount ?? 0,
            ];
        });
    }
}
