<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'location',
        'total_seats',
        'booked_seats',
        'start_time',
        'end_time',
    ];
}
