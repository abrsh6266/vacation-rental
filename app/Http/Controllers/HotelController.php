<?php

namespace App\Http\Controllers;

use App\Models\Apartment\Apartment;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function rooms($id)
    {
        $rooms = Apartment::select()->orderBy('id', 'desc')->take(6)->where('hotel_id', $id)->get();

        return view('hotels.rooms', compact('rooms'));
    }
    public function roomDetails($id)
    {
        $room = Apartment::find($id);

        return view('hotels.roomDetails', compact('room'));
    }
}
