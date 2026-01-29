<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        // $locations = Location::orderBy('created_at', 'desc')->get();
        // ditambahkan active karena yang tampil hanya yang aktif (Y)
        $locations = Location::active()->orderBy('name')->get();

        return view('admin.location.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:locations,name',
        ]);
        $validated['aktif'] = 'Y';
        Location::create($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:locations,name,' . $location->id,
        ]);
        $location->update($validated);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(Location $location)
    {
        // $location->delete();
        $location->update(['aktif' => 'N']);
        return redirect()->route('admin.locations.index')->with('success', 'Lokasi berhasil dinonaktifkan.');
    }
}
