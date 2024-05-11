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
Route::get('admin/login', [AdminController::class, 'viewLogin'])->name('view.login')->middleware('auth::web');

