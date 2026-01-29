<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'string',
    ];

    public function scopeActive($query)
    {
        return $query->where('aktif', 'Y');
    }
}
