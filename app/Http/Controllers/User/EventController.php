<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $event->load(['tickets.type', 'category', 'user', 'location']);

        // Calculate additional data
        $isExpired = $event->waktu->isPast();
        $totalStock = $event->tickets->sum('stok');

        // Ambil semua metode pembayaran
        $payments = Payment::all();

        return view('events.show', compact('event', 'isExpired', 'totalStock', 'payments'));
    }
}
