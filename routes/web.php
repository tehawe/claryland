<?php

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

// FRONT END //

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home',
    ]);
});
Route::get('/home', function () {
    return view('home', [
        'title' => 'Home',
        'active' => 'home',
    ]);
});
Route::get('/package', function () {
    return view('package', [
        'title' => 'Package',
        'active' => 'package',
    ]);
});
Route::get('/gallery', function () {
    return view('gallery', [
        'title' => 'Gallery',
        'active' => 'gallery',
    ]);
});
Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact',
        'active' => 'contact',
    ]);
});
Route::get('/FAQs', function () {
    return view('FAQs', [
        'title' => 'FAQs',
        'active' => 'FAQs',
    ]);
});

// LOGIN //

Route::get('/login', [UserController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

// BACK END //

// Dashboard

Route::get('dashboard/home', function () {
    return view('dashboard.index');
});
Route::get('dashboard/', function () {
    return view('dashboard.index');
});

Route::get('dashboard/users', function () {
    return view('dashboard.users.user');
});

// Transaction
Route::get('trx/orders', function () {
    return view('dashboard.transaction.orders');
});
Route::get('trx/', function () {
    return view('dashboard.transaction.orders');
});
Route::get('trx/sales', function () {
    return view('dashboard.transaction.sales');
});
Route::get('trx/settlement', function () {
    return view('dashboard.transaction.settlement');
});
Route::get('trx/ticket', function () {
    return view('dashboard.transaction.ticket');
});

// User
Route::get('/users', [UserController::class, 'show']);
