<?php


namespace App\Http\Controllers\Admin;


use App\Models\TicketType;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class TicketTypeController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::orderBy('created_at', 'desc')->get();
        return view('admin.ticket-type.index', compact('ticketTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:ticket_types,name',
        ]);
        TicketType::create($validated);
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil ditambahkan.');
    }

    public function update(Request $request, TicketType $ticketType)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:ticket_types,name,' . $ticketType->id,
        ]);
        $ticketType->update($validated);
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil diperbarui.');
    }

    public function destroy(TicketType $ticketType)
    {
        if ($ticketType->tickets()->count() > 0) {
            return redirect()->route('admin.ticket-types.index')->with('error', 'Tidak dapat menghapus tipe tiket yang sudah digunakan pada tiket.');
        }
        $ticketType->delete();
        return redirect()->route('admin.ticket-types.index')->with('success', 'Tipe tiket berhasil dihapus.');
    }
}
