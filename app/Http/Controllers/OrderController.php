<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'hero'])->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'hero_id' => 'required|exists:heroes,id',
            'current_rank' => 'required|string',
            'target_rank' => 'required|string',
            'price' => 'required|integer|min:0',
            'status' => 'in:Pending,In Progress,Completed,Cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $order = Order::create($request->all());
        $order->load(['customer', 'hero']);

        return response()->json([
            'message' => 'Order created successfully',
            'data' => $order
        ], 201);
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'hero'])->findOrFail($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'customer_id' => 'exists:customers,id',
            'hero_id' => 'exists:heroes,id',
            'current_rank' => 'string',
            'target_rank' => 'string',
            'price' => 'integer|min:0',
            'status' => 'in:Pending,In Progress,Completed,Cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $order->update($request->all());
        $order->load(['customer', 'hero']);

        return response()->json([
            'message' => 'Order updated successfully',
            'data' => $order
        ]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully'
        ]);
    }
}
