<?php

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

// BACK END //

Route::get('/login', function () {
    return view('login');
});
Route::get('/dashboard/home', function () {
    return view('dashboard.home');
});
Route::get('dashboard/users', function () {
    return view('dashboard.users.user');
});
Route::get('sales/orders', function () {
    return view('dashboard.sales.orders');
});
