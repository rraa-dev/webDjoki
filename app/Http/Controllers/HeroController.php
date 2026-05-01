<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::with('orders')->get();
        return response()->json($heroes);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'difficulty' => 'required|in:Easy,Medium,Hard'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hero = Hero::create($request->all());

        return response()->json([
            'message' => 'Hero created successfully',
            'data' => $hero
        ], 201);
    }

    public function show($id)
    {
        $hero = Hero::with('orders')->findOrFail($id);
        return response()->json($hero);
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'role' => 'string',
            'difficulty' => 'in:Easy,Medium,Hard'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $hero->update($request->all());

        return response()->json([
            'message' => 'Hero updated successfully',
            'data' => $hero
        ]);
    }

    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return response()->json([
            'message' => 'Hero deleted successfully (related orders also deleted due to cascade)'
        ]);
    }
}
