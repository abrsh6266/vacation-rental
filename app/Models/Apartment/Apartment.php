<?php

namespace App\Models\Apartment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $table = 'apartments';

    protected $fillable = [
        'name',
        'image',
        'max_persons',
        'price',
        'size',
        'view',
        'num_beds',
        'hotel_id',
    ];

    public $timestamps = true;
}
