<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Hero;
use Illuminate\Http\Request;

class OrderWebController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'hero'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $heroes = Hero::all();
        return view('orders.create', compact('customers', 'heroes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hero_id' => 'required|exists:heroes,id',
            'current_rank' => 'required|string',
            'target_rank' => 'required|string',
            'price' => 'required|integer|min:0',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled'
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'hero']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $heroes = Hero::all();
        return view('orders.edit', compact('order', 'customers', 'heroes'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hero_id' => 'required|exists:heroes,id',
            'current_rank' => 'required|string',
            'target_rank' => 'required|string',
            'price' => 'required|integer|min:0',
            'status' => 'required|in:Pending,In Progress,Completed,Cancelled'
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
