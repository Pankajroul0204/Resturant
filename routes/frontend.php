<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\InTouchController;

Route::get('/',[FrontendController::class,'index']);
Route::get('/booking_request_list',[FrontendController::class,'bookingRequestList'])->name('frontend.booking_request_list');
Route::post('/save_booking_dyls',[FrontendController::class,'saveBookingDtls'])->name('frontend.save_booking_dtls');
Route::post('/inTouch_create', [InTouchController::class, 'inTouchcreate'])->name('frontend.inTouch.create');
Route::post('/table_booking', [InTouchController::class, 'bookings'])->name('frontend.table_booking');
