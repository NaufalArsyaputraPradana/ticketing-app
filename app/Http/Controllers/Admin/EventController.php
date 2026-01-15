<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['kategori', 'tickets'])->get();
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.event.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/events'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        $validatedData['user_id'] = Auth::id();

        Event::create($validatedData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        $tickets = $event->tickets;

        return view('admin.event.show', compact('event', 'categories', 'tickets'));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        return view('admin.event.edit', compact('event', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $event = Event::findOrFail($id);

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'waktu' => 'required|date',
                'lokasi' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Handle file upload
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($event->gambar && file_exists(public_path('images/events/'.$event->gambar))) {
                    unlink(public_path('images/events/'.$event->gambar));
                }

                $imageName = time().'.'.$request->gambar->extension();
                $request->gambar->move(public_path('images/events'), $imageName);
                $validatedData['gambar'] = $imageName;
            }

            $event->update($validatedData);

            return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui event: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);

        // Delete image if exists
        if ($event->gambar && file_exists(public_path('images/events/'.$event->gambar))) {
            unlink(public_path('images/events/'.$event->gambar));
        }
        
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
