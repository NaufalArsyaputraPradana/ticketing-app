<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'waktu',
        'lokasi',
        'gambar',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    protected $appends = ['tickets_min_harga', 'tickets_total_stok'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Accessor for minimum ticket price
    public function getTicketsMinHargaAttribute()
    {
        return $this->tickets()->min('harga') ?? 0;
    }

    // Accessor for total ticket stock
    public function getTicketsTotalStokAttribute()
    {
        return $this->tickets()->sum('stok') ?? 0;
    }
}
