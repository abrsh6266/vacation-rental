<?php

use App\Http\Controllers\HotelController;
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
Route::get('hotels/rooms/{id}', [HotelController::class, 'rooms'])->name('hotel.rooms');
Route::get('hotels/rooms-details/{id}', [HotelController::class, 'roomDetails'])->name('hotel.rooms.details');
Route::post('hotels/rooms-booking/{id}', [HotelController::class, 'roomBooking'])->name('hotel.rooms.booking');

//payment
Route::get('hotels/pay', [HotelController::class, 'payWithPaypal'])->name('hotel.pay')->middleware('checkPrice');
Route::get('hotels/success', [HotelController::class, 'success'])->name('hotel.success')->middleware('checkPrice');