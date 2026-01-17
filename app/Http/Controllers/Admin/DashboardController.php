<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalEvents = Event::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_harga');
        $recentOrders = Order::with(['user', 'event'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('totalEvents', 'totalCategories', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }
}
