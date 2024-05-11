<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Apartment\Apartment;
use App\Models\Hotel\Hotel;
use Hash;
use Illuminate\Http\Request;

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

}