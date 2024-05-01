<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'check_in',
        'check_out',
        'days',
        'price',
        'user_id',
        'hotel_name',
        'status',
    ];

    public $timestamps = true;
}
