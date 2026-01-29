<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'event_id',
        'ticket_type_id',
        'harga',
        'stok',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class, 'ticket_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'detail_orders', 'ticket_id', 'order_id')
            ->withPivot('jumlah', 'subtotal');
    }
}
