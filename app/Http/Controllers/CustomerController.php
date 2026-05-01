<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('orders')->get();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer = Customer::create($request->all());

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ], 201);
    }

    public function show($id)
    {
        $customer = Customer::with('orders')->findOrFail($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:customers,email,' . $id,
            'phone' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $customer->update($request->all());

        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $customer
        ]);
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully (related orders also deleted due to cascade)'
        ]);
    }
}
