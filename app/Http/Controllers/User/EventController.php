<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event)
    {
        $event->load(['tickets', 'category', 'user']);

        // Calculate additional data
        $isExpired = $event->waktu->isPast();
        $totalStock = $event->tickets->sum('stok');

        return view('events.show', compact('event', 'isExpired', 'totalStock'));
    }
}
