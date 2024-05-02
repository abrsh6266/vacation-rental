<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myBookings()
    {
        $bookings = Booking::select()->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('user.bookings', compact('bookings'));
    }
}
