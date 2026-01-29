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
        'location_id',
        'gambar',
        'category_id',
        'user_id',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function category()
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
}
