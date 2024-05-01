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
    public function roomBooking(Request $request, $id)
    {
        if ($date('Y/m/d') < $request->check_in and $date('Y/m/d') < $request->check_out) {
            if($request->check_in<$request->check_out){

            }else{
                echo 'check out date must be greater!';
            }
        } else {
            echo 'invalid dates';
        }
    }
}
