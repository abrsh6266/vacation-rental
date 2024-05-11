<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'hotels'], function () {
    //hotels
    Route::get('/rooms/{id}', [HotelController::class, 'rooms'])->name('hotel.rooms');
    Route::get('/rooms-details/{id}', [HotelController::class, 'roomDetails'])->name('hotel.rooms.details');
    Route::post('/rooms-booking/{id}', [HotelController::class, 'roomBooking'])->name('hotel.rooms.booking');
    //payment
    Route::get('/pay', [HotelController::class, 'payWithPaypal'])->name('hotel.pay')->middleware('checkPrice');
    Route::get('/success', [HotelController::class, 'success'])->name('hotel.success')->middleware('checkPrice');

});


//users

Route::get('user/my-bookings', [UserController::class, 'myBookings'])->name('user.bookings')->middleware('auth::web');

// admin panel
Route::get('admin/login', [AdminController::class, 'viewLogin'])->name('view.login')->middleware('CheckLogin');
Route::post('admin/login', [AdminController::class, 'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.dashboard');



    //admins
    Route::get('/all-admins', [AdminController::class, 'allAdmins'])->name('admin.all');
    Route::get('/create-admin', [AdminController::class, 'createAdmin'])->name('admin.create');
    Route::post('/create-admin', [AdminController::class, 'storeAdmin'])->name('admin.store');


    //hotels
    Route::get('/all-hotels', [AdminController::class, 'allHotels'])->name('hotels.all');
    Route::get('/create-hotel', [AdminController::class, 'createHotel'])->name('hotel.create');
    Route::post('/create-hotel', [AdminController::class, 'storeHotel'])->name('hotel.store');
    Route::get('/edit-hotel/{id}', [AdminController::class, 'editHotel'])->name('hotel.edit');
    Route::put('/edit-hotel/{id}', [AdminController::class, 'updateHotel'])->name('hotel.edit');
    Route::delete('/delete-hotel/{id}', [AdminController::class, 'deleteHotel'])->name('hotel.delete');


    //rooms
    Route::get('/all-rooms', [AdminController::class, 'allRooms'])->name('rooms.all');
    Route::get('/create-room', [AdminController::class, 'createRoom'])->name('room.create');
    Route::post('/create-room', [AdminController::class, 'storeRoom'])->name('room.store');

});
