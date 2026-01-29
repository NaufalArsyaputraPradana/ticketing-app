<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['category', 'tickets'])->orderBy('created_at', 'desc')->get();
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = Location::orderBy('name')->get();
        return view('admin.event.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'waktu' => 'required|date|after:now',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ], [
            'judul.required' => 'Judul event wajib diisi.',
            'judul.max' => 'Judul event maksimal 255 karakter.',
            'deskripsi.required' => 'Deskripsi event wajib diisi.',
            'waktu.required' => 'Waktu event wajib diisi.',
            'waktu.date' => 'Format waktu tidak valid.',
            'waktu.after' => 'Waktu event harus di masa depan.',
            'location_id.required' => 'Lokasi event wajib dipilih.',
            'location_id.exists' => 'Lokasi tidak valid.',
            'category_id.required' => 'Kategori event wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'gambar.required' => 'Gambar event wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images/events'), $imageName);
                $validatedData['gambar'] = $imageName;
            }

            $validatedData['user_id'] = Auth::id();
            Event::create($validatedData);

            return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
        } catch (\Exception $e) {
            if (isset($imageName) && file_exists(public_path('images/events/' . $imageName))) {
                unlink(public_path('images/events/' . $imageName));
            }

            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan event: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        $tickets = $event->tickets;
        $ticket_types = TicketType::all();

    return view('admin.event.show', compact('event', 'categories', 'tickets', 'ticket_types'));
    }

    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Category::all();
        $locations = Location::orderBy('name')->get();
        return view('admin.event.edit', compact('event', 'categories', 'locations'));
    }

    public function update(Request $request, string $id)
    {
        try {
            $event = Event::findOrFail($id);

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'waktu' => 'required|date',
                'location_id' => 'required|exists:locations,id',
                'category_id' => 'required|exists:categories,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            ], [
                'judul.required' => 'Judul event wajib diisi.',
                'judul.max' => 'Judul event maksimal 255 karakter.',
                'deskripsi.required' => 'Deskripsi event wajib diisi.',
                'waktu.required' => 'Waktu event wajib diisi.',
                'waktu.date' => 'Format waktu tidak valid.',
                'location_id.required' => 'Lokasi event wajib dipilih.',
                'location_id.exists' => 'Lokasi tidak valid.',
                'category_id.required' => 'Kategori event wajib dipilih.',
                'category_id.exists' => 'Kategori tidak valid.',
                'gambar.image' => 'File harus berupa gambar.',
                'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
                'gambar.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            $oldImage = $event->gambar;

            if ($request->hasFile('gambar')) {
                $imageName = time() . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('images/events'), $imageName);
                $validatedData['gambar'] = $imageName;

                if ($oldImage && file_exists(public_path('images/events/' . $oldImage))) {
                    unlink(public_path('images/events/' . $oldImage));
                }
            }

            $event->update($validatedData);

            return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            if (isset($imageName) && file_exists(public_path('images/events/' . $imageName))) {
                unlink(public_path('images/events/' . $imageName));
            }

            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui event: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);

            if ($event->orders()->count() > 0) {
                return redirect()->route('admin.events.index')->with('error', 'Event tidak dapat dihapus karena sudah ada pemesanan.');
            }

            $event->tickets()->delete();

            if ($event->gambar && file_exists(public_path('images/events/' . $event->gambar))) {
                unlink(public_path('images/events/' . $event->gambar));
            }

            $event->delete();

            return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus event: ' . $e->getMessage());
        }
    }
}
