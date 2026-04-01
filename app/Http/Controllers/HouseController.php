<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class HouseController extends Controller
{
    /**
     * Admin Dashboard: List all houses.
     */
    public function index()
    {
        return Inertia::render('Admin/Houses/Index', [
            'houses' => House::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Houses/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|string',
            'status' => 'required|in:Dijual,Disewa',
            'beds' => 'required|numeric',
            'baths' => 'required|numeric',
            'area' => 'required|numeric',
            'is_new' => 'boolean',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('houses', 'public');
        }

        House::create($validated);

        return redirect()->route('admin.houses.index')->with('success', 'Rumah berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        return Inertia::render('Admin/Houses/Edit', [
            'house' => $house
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, House $house)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|string',
            'status' => 'required|in:Dijual,Disewa',
            'beds' => 'required|numeric',
            'baths' => 'required|numeric',
            'area' => 'required|numeric',
            'is_new' => 'boolean',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($house->image) {
                Storage::disk('public')->delete($house->image);
            }
            $validated['image'] = $request->file('image')->store('houses', 'public');
        }

        $house->update($validated);

        return redirect()->route('admin.houses.index')->with('success', 'Rumah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        if ($house->image) {
            Storage::disk('public')->delete($house->image);
        }
        $house->delete();

        return redirect()->route('admin.houses.index')->with('success', 'Rumah berhasil dihapus!');
    }

    /**
     * Public Landing Page.
     */
    public function landing()
    {
        return Inertia::render('Welcome', [
            'houses' => House::latest()->get()
        ]);
    }
}
