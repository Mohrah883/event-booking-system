<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'seats_booked',
    ];

    public function event()
    {
        return $this->belongsTo(\App\Models\Event::class);
    }
}
