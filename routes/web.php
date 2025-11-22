<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ChefController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\InTouchController;
use App\Http\Controllers\Admin\NotificationController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
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
    // chef
    Route::resource('chef', ChefController::class)->names([
        'index' => 'admin.chef.index',
        'create' => 'admin.chef.create',
        'store' => 'admin.chef.store',
        'show' => 'admin.chef.show',
        'edit' => 'admin.chef.edit',
        'update' => 'admin.chef.update',
        'destroy' => 'admin.chef.destroy',
    ]);

    // about
    Route::resource('about', AboutController::class)->names([
        'index' => 'admin.about.index',
        'create' => 'admin.about.create',
        'store' => 'admin.about.store',
        'show' => 'admin.about.show',
        'edit' => 'admin.about.edit',
        'update' => 'admin.about.update',
        'destroy' => 'admin.about.destroy',
    ]);

    // notifications
    Route::get('/count-notifications',[NotificationController::class,'index'])->name('admin.count_notifications'); //   count
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.notifications');
    Route::get('/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('admin.mark_as_read');

    // log-file url
    Route::get('logs', [LogViewerController::class, 'index']);
    Route::get('editor', function () {
        return Inertia::render('Ckeditor');
    })->name('admin.editors');
});
