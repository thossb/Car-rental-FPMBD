<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\BookingController;

use App\Http\Controllers\User\UserCarController;
use App\Http\Controllers\AuthUserController;
// use App\Http\Controllers\User\UserBranchController;

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

Route::get('/', [App\Http\Controllers\User\UserCarController::class, 'dashboard_user'])->name('homepage');
Route::get('contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('detail', [\App\Http\Controllers\HomeController::class, 'detail'])->name('detail');

Route::get('admin/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('admin/car', [\App\Http\Controllers\Admin\CarController::class, 'index'])->name('admin.car.index');
Route::post('admin/car/getDetail', [\App\Http\Controllers\Admin\CarController::class, 'getDetail'])->name('admin.car.getDetail');
Route::post('admin/car/store', [\App\Http\Controllers\Admin\CarController::class, 'store'])->name('admin.car.store');
Route::post('admin/car/update', [\App\Http\Controllers\Admin\CarController::class, 'update'])->name('admin.car.update');
Route::get('admin/car/{id}/destroy', [\App\Http\Controllers\Admin\CarController::class, 'destroy'])->name('admin.car.destroy');

Route::get('admin/driver', [\App\Http\Controllers\Admin\DriverController::class, 'index'])->name('admin.driver.index');
Route::post('admin/driver/getDetail', [\App\Http\Controllers\Admin\DriverController::class, 'getDetail'])->name('admin.driver.getDetail');
Route::post('admin/driver/store', [\App\Http\Controllers\Admin\DriverController::class, 'store'])->name('admin.driver.store');
Route::post('admin/driver/update', [\App\Http\Controllers\Admin\DriverController::class, 'update'])->name('admin.driver.update');
Route::get('admin/driver/{id}/destroy', [\App\Http\Controllers\Admin\DriverController::class, 'destroy'])->name('admin.driver.destroy');

Route::get('admin/booking', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.booking.index');
Route::post('admin/booking/getDetail', [\App\Http\Controllers\Admin\BookingController::class, 'getDetail'])->name('admin.booking.getDetail');
Route::post('admin/booking/store', [\App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.booking.store');
Route::post('admin/booking/update', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('admin.booking.update');
Route::post('admin/booking/addFine', [\App\Http\Controllers\Admin\BookingController::class, 'addFine'])->name('admin.booking.addFine');
Route::get('admin/booking/{id}/destroy', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.booking.destroy');

Route::get('admin/feedback', [\App\Http\Controllers\Admin\BookingController::class, 'feedback'])->name('admin.feedback.index');
Route::post('admin/feedback/getDetail', [\App\Http\Controllers\Admin\BookingController::class, 'getDetail'])->name('admin.feedback.getDetail');
Route::post('admin/feedback/store', [\App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.feedback.store');
Route::post('admin/feedback/update', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('admin.feedback.update');
Route::get('admin/feedback/{id}/destroy', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.feedback.destroy');

Route::get('admin/branch', [\App\Http\Controllers\Admin\BranchController::class, 'index'])->name('admin.branch.index');
Route::post('admin/branch/getDetail', [\App\Http\Controllers\Admin\BranchController::class, 'getDetail'])->name('admin.branch.getDetail');
Route::post('admin/branch/store', [\App\Http\Controllers\Admin\BranchController::class, 'store'])->name('admin.branch.store');
Route::post('admin/branch/update', [\App\Http\Controllers\Admin\BranchController::class, 'update'])->name('admin.branch.update');
Route::get('admin/branch/{id}/destroy', [\App\Http\Controllers\Admin\BranchController::class, 'destroy'])->name('admin.branch.destroy');

Auth::routes();

Route::get('/customer_login', [App\Http\Controllers\AuthUserController::class, 'index'])->name('customer.login');
Route::get('/customer_logout', [App\Http\Controllers\AuthUserController::class, 'userLogout'])->name('customer.logout');
Route::post('/post_login', [App\Http\Controllers\AuthUserController::class, 'postLogin'])->name('customer.post.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/feedback', [App\Http\Controllers\User\UserCarController::class, 'feedback'])->name('feedback');
Route::get('/search_car', [App\Http\Controllers\User\UserCarController::class, 'search_car'])->name('search_car');
Route::get('/dashboard_user', [App\Http\Controllers\User\UserCarController::class, 'dashboard_user'])->name('dashboard_user');

Route::post('/searching_car', [App\Http\Controllers\User\UserCarController::class, 'searching_car'])->name('searching_car');
Route::get('/register_custom', [App\Http\Controllers\User\UserCarController::class, 'register'])->name('register_custom');

Route::post('/action_register', [App\Http\Controllers\User\UserCarController::class, 'action_register'])->name('action_register');
Route::get('/list_car', [App\Http\Controllers\User\UserCarController::class, 'list_car'])->name('list_car');
Route::get('/detail_car/{id}', [App\Http\Controllers\User\UserCarController::class, 'detail_car'])->name('detail_car');
Route::get('/book/{id}', [App\Http\Controllers\User\UserCarController::class, 'book'])->name('book');
Route::post('/booking_finish', [App\Http\Controllers\User\UserCarController::class, 'booking_finish'])->name('booking.finish');
Route::post('/payment_details', [App\Http\Controllers\User\UserCarController::class, 'payment_details'])->name('payment_details');

Route::get('/booking_history', [App\Http\Controllers\User\UserCarController::class, 'booking_history'])->name('booking_history');

Route::get('/manage_booking', [App\Http\Controllers\HomeController::class, 'manage_booking'])->name('manage_booking');

Route::get('/payment_receipt/{id}', [App\Http\Controllers\User\UserCarController::class, 'payment_receipt'])->name('payment_receipt');

