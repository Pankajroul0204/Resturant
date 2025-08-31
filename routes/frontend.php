<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\InTouchController;


Route::post('/inTouch_create', [InTouchController::class, 'inTouchcreate'])->name('frontend.inTouch.create');
Route::post('/table_booking', [InTouchController::class, 'bookings'])->name('frontend.table_booking');
