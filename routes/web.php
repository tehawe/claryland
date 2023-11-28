<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PasswordController;

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

Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// BACK END //

// Dashboard

Route::get('/dashboard/home', function () {
    return view('dashboard.index');
})->middleware('auth');
Route::get('dashboard/', function () {
    return view('dashboard.index');
})->middleware('auth');

// Users
Route::resource('/dashboard/users', UserController::class)
    ->scoped([
        'user' => 'username',
    ])
    ->except('delete')
    ->middleware('auth');

// Reset Password
Route::patch('/dashboard/users/{user:username}/password/reset', [PasswordController::class, 'update'])->middleware('auth');

// Update Password
Route::get('/dashboard/users/{user:username}/password/edit', [PasswordController::class, 'update'])->middleware('auth');
Route::patch('/dashboard/users/password/{user:username}/update', [PasswordController::class, 'update'])->middleware('auth');

// Category
Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');

// Product
Route::resource('/dashboard/products', ProductController::class)->middleware('auth');

// Packages
Route::resource('/dashboard/packages', PackageController::class)->middleware('auth');

// Transaction

// Orders
Route::resource('/transactions/orders', OrderController::class)->middleware('auth');

Route::get('/transactions/sales', function () {
    return view('dashboard.transactions.sales');
});
Route::get('transactions/settlement', function () {
    return view('dashboard.transactions.settlement');
});
Route::get('transactions/ticket', function () {
    return view('dashboard.transactions.ticket');
});
