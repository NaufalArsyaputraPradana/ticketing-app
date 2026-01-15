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
            ->orderBy('waktu', 'asc');

        if ($request->has('kategori') && $request->kategori) {
            $eventsQuery->where('category_id', $request->kategori);
        }

        $events = $eventsQuery->get();

        return view('home', compact('events', 'categories'));
    }
}
