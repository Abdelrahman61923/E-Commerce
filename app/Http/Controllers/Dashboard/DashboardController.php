<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\Dashboard\DashboardService;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService)
    {
        $orders = $dashboardService->getAll();

        $dashboardData = $dashboardService->getDashboardStats();

        $monthlyDatas = $dashboardService->getMonthlyStats();

        $collection = collect($monthlyDatas);
        $charts = [
            'amounts' => $collection->pluck('TotalAmount')->implode(','),
            'ordered' => $collection->pluck('TotalOrderedAmount')->implode(','),
            'delivered' => $collection->pluck('TotalDeliveredAmount')->implode(','),
            'canceled' => $collection->pluck('TotalCanceledAmount')->implode(','),
        ];

        $totals = [
            'all' => $collection->sum('TotalAmount'),
            'ordered' => $collection->sum('TotalOrderedAmount'),
            'delivered' => $collection->sum('TotalDeliveredAmount'),
            'canceled' => $collection->sum('TotalCanceledAmount'),
        ];

        return view('dashboard.index', [
            'orders' => $orders,
            'stats' => $dashboardData,
            'charts' => $charts,
            'totals' => $totals,
        ]);
    }
}
