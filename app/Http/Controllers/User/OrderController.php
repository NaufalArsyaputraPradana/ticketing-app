<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Ticket;
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
            ->with(['event', 'detailOrders.ticket'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('orders.index', compact('orders'));
    }

    // show a specific order
    public function show(Order $order)
    {
        $order->load('detailOrders.ticket', 'event');
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
        ]);

        $user = Auth::user();

        try {
            // transaction
            $order = DB::transaction(function () use ($data, $user) {
                $total = 0;
                // validate stock and calculate total
                foreach ($data['items'] as $it) {
                    $t = Ticket::lockForUpdate()->findOrFail($it['ticket_id']);
                    if ($t->stok < $it['jumlah']) {
                        throw new \Exception("Stok tidak cukup untuk tipe: {$t->type}");
                    }
                    $total += ($t->harga ?? 0) * $it['jumlah'];
                }

                $order = Order::create([
                    'user_id' => $user->id,
                    'event_id' => $data['event_id'],
                    'order_date' => Carbon::now(),
                    'total_harga' => $total,
                ]);

                foreach ($data['items'] as $it) {
                    $t = Ticket::findOrFail($it['ticket_id']);
                    $subtotal = ($t->harga ?? 0) * $it['jumlah'];
                    DetailOrder::create([
                        'order_id' => $order->id,
                        'ticket_id' => $t->id,
                        'jumlah' => $it['jumlah'],
                        'subtotal' => $subtotal,
                    ]);

                    // reduce stock
                    $t->stok = max(0, $t->stok - $it['jumlah']);
                    $t->save();
                }

                return $order;
            });

            // flash success message to session so it appears after redirect
            session()->flash('success', 'Pesanan berhasil dibuat.');

            return response()->json(['ok' => true, 'order_id' => $order->id, 'redirect' => route('orders.index')]);
        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
