<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('events')->orderBy('nama')->get();

        $eventsQuery = Event::with(['category', 'tickets'])
            ->orderBy('waktu', 'asc'); // Show all events (including expired)

        // Filter by category
        if ($request->filled('category')) {
            $eventsQuery->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $search = trim($request->search);
            $eventsQuery->where(function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('lokasi', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Show all events (including those with stok 0 or expired)
        $eventsQuery->whereHas('tickets'); // Only require that event has tickets

        $events = $eventsQuery->get()->map(function ($event) {
            // Calculate minimum ticket price
            // First try from available stock (stok > 0)
            $minPrice = $event->tickets->where('stok', '>', 0)->min('harga');
            
            // If no tickets available, show price from all tickets (for sold out events)
            if (!$minPrice) {
                $minPrice = $event->tickets->min('harga') ?? 0;
            }
            
            $event->tickets_min_harga = $minPrice;
            
            // Calculate total stock directly (no separate property)
            $totalStok = $event->tickets->sum('stok');
            
            // Add flags for sorting
            $event->is_expired = $event->waktu < now();
            $event->is_sold_out = $totalStok <= 0;
            $event->is_available = !$event->is_expired && !$event->is_sold_out;
            
            return $event;
        })->sort(function ($a, $b) {
            // Priority sorting: Available events first, then expired/sold out
            
            // Step 1: Compare by availability (available events come first)
            if ($a->is_available && !$b->is_available) {
                return -1; // a comes before b (a is available, b is not)
            }
            if (!$a->is_available && $b->is_available) {
                return 1; // b comes before a (b is available, a is not)
            }
            
            // Step 2: If both have same availability status, sort by event date (ascending)
            return $a->waktu <=> $b->waktu; // Earlier date comes first
        })->values();

        return view('home', compact('events', 'categories'));
    }
}
