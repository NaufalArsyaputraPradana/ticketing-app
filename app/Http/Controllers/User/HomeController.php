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
        $categories = Category::all();

        $eventsQuery = Event::withMin('tickets', 'harga')
            ->withSum('tickets', 'stok')
            ->orderBy('waktu', 'asc');

        // Filter by category
        if ($request->has('kategori') && $request->kategori) {
            $eventsQuery->where('category_id', $request->kategori);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $eventsQuery->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                      ->orWhere('lokasi', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        $events = $eventsQuery->get();

        return view('home', compact('events', 'categories'));
    }
}
