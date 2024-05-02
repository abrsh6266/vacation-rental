<?php

namespace App\Http\Controllers;

use App\Models\Apartment\Apartment;
use App\Models\Booking;
use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;
use Redirect;
use Session;

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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
        ]);
        $room = Apartment::find($id);
        $hotelId = $room->hotel_id;
        $hotel = Hotel::find($hotelId);
        $currentDate = now()->format('Y-m-d');

        // Check if check-in and check-out dates are valid
        if ($currentDate < $request->check_in && $request->check_in < $request->check_out) {
            $checkIn = new \DateTime($request->check_in);
            $checkOut = new \DateTime($request->check_out);
            $days = $checkIn->diff($checkOut)->days;

            $booking = Booking::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'days' => $days,
                'price' => $days * $room->price,
                'user_id' => auth()->user()->id,
                'hotel_name' => $hotel->name,
                'room_name' => $room->name,
                'status' => 'pending',
            ]);
            $totalPrice = $days * $room->price;
            $price = Session::put('price', $totalPrice);
            $getPrice = Session::get($price);
            return Redirect::route('hotel.pay');
        } else {
            Session::flash('error', 'Invalid dates');
            return redirect()->back();
        }

    }
    public function payWithPaypal()
    {
        return view('hotels.pay');
    }
    public function success()
    {
        Session::forget('price');
        return view('hotels.success');
    }
}
