<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
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




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

Route::get('/home',[PageController::class,'index'])->name('user.index');
Route::get('hotel',[PageController::class,'hotel'])->name('user.hotel');
Route::get('hotel/view/{id}',[PageController::class,'view'])->name('user.view');
Route::get('/',[PageController::class,'welcome'])->name('welcome');

Route::middleware('auth')->group(function () {



//booking  
Route::post('/booking/store',[BookingController::class,'store'])->name('booking.store');

//esewa


Route::get('/esewa/success',[EsewaController::class,'esewaSuccess'])->name('esewa.success');
Route::post('/esewa/fail',[EsewaController::class,'esewaFail'])->name('esewa.fail');
});



//admin
Route::middleware(['admin'])->group(function () {
Route::get('/dashboard',[PageController::class,'admin'])->name('dashboard');
Route::get('/rooms', [RoomController::class, 'index'])->name('room.index');
Route::get('/rooms/create', [RoomController::class, 'create'])->name('room.create');
Route::post('/rooms/store', [RoomController::class, 'store'])->name('room.store');
Route::get('/rooms/edit/{id}',[RoomController::class,'edit'])->name('room.edit');
Route::post('/rooms/update/{id}',[RoomController::class,'update'])->name('room.update');
Route::get('/rooms/delete/{id}',[RoomController::class,'destroy'])->name('room.delete');

});