<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroWebController extends Controller
{
    public function index()
    {
        $heroes = Hero::withCount('orders')->paginate(10);
        return view('heroes.index', compact('heroes'));
    }

    public function create()
    {
        return view('heroes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'difficulty' => 'required|in:Easy,Medium,Hard'
        ]);

        Hero::create($validated);

        return redirect()->route('heroes.index')
            ->with('success', 'Hero created successfully!');
    }

    public function show(Hero $hero)
    {
        $hero->load('orders.customer');
        return view('heroes.show', compact('hero'));
    }

    public function edit(Hero $hero)
    {
        return view('heroes.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'difficulty' => 'required|in:Easy,Medium,Hard'
        ]);

        $hero->update($validated);

        return redirect()->route('heroes.index')
            ->with('success', 'Hero updated successfully!');
    }

    public function destroy(Hero $hero)
    {
        $hero->delete();

        return redirect()->route('heroes.index')
            ->with('success', 'Hero deleted successfully! Related orders also deleted.');
    }
}
