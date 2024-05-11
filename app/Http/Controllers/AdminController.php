<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apartment\Apartment;
use App\Models\Hotel\Hotel;
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

}