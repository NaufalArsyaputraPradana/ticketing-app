<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        abort(404);
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type' => 'required|in:reguler,premium',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ], [
            'event_id.required' => 'Event ID wajib diisi.',
            'event_id.exists' => 'Event tidak ditemukan.',
            'type.required' => 'Tipe tiket wajib diisi.',
            'type.in' => 'Tipe tiket harus reguler atau premium.',
            'harga.required' => 'Harga tiket wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok.required' => 'Stok tiket wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'stok.min' => 'Stok tidak boleh negatif.',
        ]);

        // Check if ticket type already exists for this event
        $existingTicket = Ticket::where('event_id', $validatedData['event_id'])
            ->where('type', $validatedData['type'])
            ->first();

        if ($existingTicket) {
            return redirect()
                ->route('admin.events.show', $validatedData['event_id'])
                ->with('error', 'Tiket dengan tipe ' . $validatedData['type'] . ' sudah ada untuk event ini.');
        }

        // Create the ticket
        Ticket::create($validatedData);

        return redirect()->route('admin.events.show', $validatedData['event_id'])->with('success', 'Tiket berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        abort(404);
    }

    public function edit(string $id)
    {
        abort(404);
    }

    public function update(Request $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validatedData = $request->validate([
            'type' => 'required|in:reguler,premium',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ], [
            'type.required' => 'Tipe tiket wajib diisi.',
            'type.in' => 'Tipe tiket harus reguler atau premium.',
            'harga.required' => 'Harga tiket wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
            'stok.required' => 'Stok tiket wajib diisi.',
            'stok.integer' => 'Stok harus berupa bilangan bulat.',
            'stok.min' => 'Stok tidak boleh negatif.',
        ]);

        // Check if changing type would create duplicate
        if ($ticket->type !== $validatedData['type']) {
            $existingTicket = Ticket::where('event_id', $ticket->event_id)
                ->where('type', $validatedData['type'])
                ->where('id', '!=', $id)
                ->first();

            if ($existingTicket) {
                return redirect()
                    ->route('admin.events.show', $ticket->event_id)
                    ->with('error', 'Tiket dengan tipe ' . $validatedData['type'] . ' sudah ada untuk event ini.');
            }
        }

        $ticket->update($validatedData);

        return redirect()
            ->route('admin.events.show', $ticket->event_id)
            ->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $eventId = $ticket->event_id;

            if ($ticket->detailOrders()->count() > 0) {
                return redirect()
                    ->route('admin.events.show', $eventId)
                    ->with('error', 'Tiket tidak dapat dihapus karena sudah ada pemesanan.');
            }

            $ticket->delete();

            return redirect()
                ->route('admin.events.show', $eventId)
                ->with('success', 'Tiket berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus tiket: ' . $e->getMessage());
        }
    }
}
