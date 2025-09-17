<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\InTouchController;

include('frontend.php');
include('payment.php');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::post('/admin/create', [HeroController::class, 'create'])->name('admin.create');
    Route::match(['get', 'post'], '/heroPage/{resturant_id?}', [HeroController::class, 'hero'])->name('admin.heroPage');
    Route::get('/heroPageList', [HeroController::class, 'heroList'])->name('admin.HeroList');
    Route::delete('/heroDelete/{resturant_id}', [HeroController::class, 'deleteHero'])->name('admin.heroDelete');
    // testimonials
    Route::match(['get', 'post'], '/testimonials', [TestimonialController::class, 'getCreateTestimonials'])->name('admin.testimonials');
    Route::get('/testimonial_list', [TestimonialController::class, 'testimonial_list'])->name('admin.testimonials_list');
    Route::delete('/testimonial_delete/{id}', [TestimonialController::class, 'deleteTestimonial'])->name('admin.testimonial_delete');
    // in touch
    Route::get('/customer_intouchlist', [InTouchController::class, 'intouchList'])->name('admin.intouch_list');
    // menu
    Route::resource('menu', MenuController::class);
    Route::get('/menulist', [MenuController::class, 'menulist'])->name('admin.menulist');
});
