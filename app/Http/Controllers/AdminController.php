<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apartment\Apartment;
use App\Models\Booking;
use App\Models\Hotel\Hotel;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view('admin.login');
    }
    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }
    public function index()
    {
        $adminsCount = Admin::select()->count();
        $hotelsCount = Hotel::select()->count();
        $roomsCount = Apartment::select()->count();
        return view('admin.index', compact('adminsCount', 'hotelsCount', 'roomsCount'));
    }
    public function allAdmins()
    {
        $admins = Admin::select()->orderBy('id', 'desc')->get();
        return view('admin.all', compact('admins'));
    }
    public function createAdmin()
    {
        return view('admin.create');
    }
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6',
        ]);
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'Admin created successfully');
    }
    public function allHotels()
    {
        $hotels = Hotel::select()->orderBy('id', 'desc')->get();
        return view('admin.allhotels', compact('hotels'));
    }
    public function createHotel()
    {
        return view('admin.createhotel');
    }
    public function storeHotel(Request $request)
    {
        try {
            // Validate input data
            $request->validate([
                'name' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
                'description' => 'required|string',
                'location' => 'required|string',
            ]);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images'), $imageName);
            } else {
                $imageName = '';
            }
            $hotel = Hotel::create([
                'name' => $request->name,
                'image' => $imageName,
                'description' => $request->description,
                'location' => $request->location,
            ]);
            return redirect()->back()->with('success', 'Hotel created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create hotel');
        }
    }
    public function editHotel($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            return view('admin.edithotel', compact('hotel'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hotel not found');
        }
    }
    public function updateHotel(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
                'location' => 'required|string',
            ]);
            $hotel = Hotel::findOrFail($id);
            $hotel->update([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $request->location,
            ]);
            return redirect()->back()->with('success', 'Hotel updated successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update hotel');
        }
    }
    public function deleteHotel($id)
    {
        try {
            $hotel = Hotel::findOrFail($id);
            $imagePath = public_path('assets/images/' . $hotel->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $hotel->delete();
            return redirect()->back()->with('success', 'Hotel deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete hotel');
        }
    }

    public function allRooms()
    {
        $rooms = Apartment::select()->orderBy('id', 'desc')->get();
        return view('admin.allrooms', compact('rooms'));
    }
    public function createRoom()
    {
        $hotels = Hotel::select()->orderBy('id', 'desc')->get();
        return view('admin.createroom', compact('hotels'));
    }
    public function storeRoom(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
                'max_persons' => 'required|integer|min:1',
                'size' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'num_beds' => 'required|integer|min:1',
                'view' => 'required|string',
                'hotel_id' => 'required|exists:hotels,id',
            ]);


            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);

            $room = Apartment::create([
                'name' => $request->name,
                'image' => $imageName,
                'max_persons' => $request->max_persons,
                'size' => $request->size,
                'num_beds' => $request->num_beds,
                'price' => $request->price,
                'view' => $request->view,
                'hotel_id' => $request->hotel_id,
            ]);
            return redirect()->back()->with('success', 'Room created successfully');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create room');
        }
    }
    public function deleteRoom($id)
    {
        try {
            $room = Apartment::findOrFail($id);
            $imagePath = public_path('assets/images/' . $room->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            $room->delete();
            return redirect()->back()->with('success', 'Room deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete room');
        }
    }
    public function allBookings()
    {
        $bookings = Booking::select()->orderBy('id', 'desc')->get();
        return view('admin.allbooking', compact('bookings'));
    }
    public function deleteBooking($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return redirect()->back()->with('success', 'Booking deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete booking');
        }
    }
}