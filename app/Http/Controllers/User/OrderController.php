<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->with(['event', 'detailOrders.ticket', 'payment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    // show a specific order
    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('detailOrders.ticket', 'event', 'payment');

        return view('orders.show', compact('order'));
    }


    // store an order (AJAX POST)
    public function store(Request $request)
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'items' => 'required|array|min:1',
            'items.*.ticket_id' => 'required|integer|exists:tickets,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'payment_id' => 'required|exists:payments,id',
        ]);

        $user = Auth::user();

        // Check if event is expired
        $event = Event::findOrFail($data['event_id']);
        if ($event->waktu->isPast()) {
            return response()->json([
                'ok' => false,
                'message' => 'Event sudah berakhir. Tidak bisa membeli tiket.'
            ], 422);
        }

        try {
            $order = DB::transaction(function () use ($data, $user, $event) {
                $total = 0;
                $ticketData = [];

                // Validate stock and calculate total
                foreach ($data['items'] as $it) {
                    $ticket = Ticket::lockForUpdate()->findOrFail($it['ticket_id']);

                    // Verify ticket belongs to the event
                    if ($ticket->event_id != $data['event_id']) {
                        throw new \Exception("Tiket tidak valid untuk event ini.");
                    }

                    // Check stock availability
                    if ($ticket->stok < $it['jumlah']) {
                        throw new \Exception("Stok tidak cukup untuk tiket {$ticket->type}. Sisa stok: {$ticket->stok}");
                    }

                    if ($ticket->stok <= 0) {
                        throw new \Exception("Tiket {$ticket->type} sudah habis.");
                    }

                    $subtotal = $ticket->harga * $it['jumlah'];
                    $total += $subtotal;

                    $ticketData[] = [
                        'ticket' => $ticket,
                        'jumlah' => $it['jumlah'],
                        'subtotal' => $subtotal,
                    ];
                }

                // Create order
                $order = Order::create([
                    'user_id' => $user->id,
                    'event_id' => $data['event_id'],
                    'order_date' => Carbon::now(),
                    'total_harga' => $total,
                    'payment_id' => $data['payment_id'],
                ]);

                // Create detail orders and reduce stock
                foreach ($ticketData as $data) {
                    DetailOrder::create([
                        'order_id' => $order->id,
                        'ticket_id' => $data['ticket']->id,
                        'jumlah' => $data['jumlah'],
                        'subtotal' => $data['subtotal'],
                    ]);

                    // Reduce stock
                    $data['ticket']->decrement('stok', $data['jumlah']);
                }

                return $order;
            });

            session()->flash('success', 'Pesanan berhasil dibuat! Total: Rp ' . number_format($order->total_harga, 0, ',', '.'));

            return response()->json(['ok' => true, 'order_id' => $order->id, 'redirect' => route('orders.index')]);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
