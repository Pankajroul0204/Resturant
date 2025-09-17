<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Payment\PaymentController;

// Route::get('/payment/{id}', [PaymentController::class, 'order']);
Route::get('/payment/order', [PaymentController::class, 'order']);
Route::get('/payment/orderdetails', [PaymentController::class, 'orderdetails']);
Route::get('/payment/success',[PaymentController::class,'success'])->name('success');
Route::get('/payment/cancel',[PaymentController::class,'cancel'])->name('cancel');

