<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Hero;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();
        $totalHeroes = Hero::count();

        $recentOrders = Order::with(['customer', 'hero'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalOrders',
            'totalCustomers',
            'totalHeroes',
            'recentOrders'
        ));
    }
}
