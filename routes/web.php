<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TicketController;
use App\Models\Stock;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

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

Route::get('/', function (Request $request) {
    return view('home', [
        'title' => 'Home',
        'active' => 'home',
        'info' => $request->header('User-Agent'),
    ]);
});
Route::get('/home', function (Request $request) {
    return view('home', [
        'title' => 'Home',
        'active' => 'home',
        'info' => $request->header('User-Agent'),
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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// BACK END //

// Dashboard Route
Route::get('/dashboard/home', function () {
    return view('dashboard.index');
})->middleware('admin');
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('admin');


// Users
Route::resource('/users', UserController::class)
    ->scoped([
        'user' => 'username',
    ])
    ->except('delete')
    ->middleware('auth');

// Reset Password
Route::patch('/users/{user:username}/password/reset', [PasswordController::class, 'reset'])->name('users.password.reset')->middleware('auth');
// Update Password
Route::patch('/users/{user:username}/password/update', [PasswordController::class, 'update'])->name('users.password.update')->middleware('auth');

Route::middleware('admin')->group(function () {
    // Category
    Route::get('/dashboard/categories/data', [CategoryController::class, 'data']);
    Route::get('/dashboard/categories/{category:id}/remove', [CategoryController::class, 'remove']);
    Route::resource('/dashboard/categories', CategoryController::class)->middleware('auth');

    // Product
    Route::get('/dashboard/products/data', [ProductController::class, 'data']);
    Route::resource('/dashboard/products', ProductController::class);

    // Stock
    Route::get('/dashboard/products/{product:id}/stocks/data', [StockController::class, 'data']);
    Route::get('/dashboard/products/{product:id}/stocks/in', [StockController::class, 'createStockIn']);
    Route::get('/dashboard/products/{product:id}/stocks/out', [StockController::class, 'createStockOut']);
    Route::post('/dashboard/products/{product:id}/stocks/', [StockController::class, 'store']);
    Route::get('/dashboard/products/{product:id}/stocks/{stock:id}/edit', [StockController::class, 'edit']);
    Route::patch('/dashboard/products/{product:id}/stocks/{stock:id}', [StockController::class, 'update']);
    Route::get('/dashboard/products/{product:id}/stocks/{stock:id}/remove', [StockController::class, 'remove']);
    Route::delete('/dashboard/products/{product:id}/stocks/{stock:id}', [StockController::class, 'destroy']);

    // Packages
    Route::resource('/dashboard/packages', PackageController::class);

    // Reports
    Route::get('/dashboard/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/dashboard/reports/{date}/daily', [ReportController::class, 'daily'])->name('reports.daily');
    Route::get('/dashboard/reports/{date}/daily/transaction', [ReportController::class, 'dailyTransaction'])->name('reports.daily.transactions');
    Route::get('/dashboard/reports/{date}/daily/stock', [ReportController::class, 'dailyStock'])->name('reports.daily.stock');

    // CUSTOMER CONTACT
    Route::get('/dashboard/contacts', [ContactController::class, 'index'])->name('contacts');
});

Route::middleware('auth')->group(function () {
    // Transaction

    // Orders Ticket
    Route::get('/transactions/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/transactions/orders/{order:invoice}/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/transactions/orders/{order:invoice}/store', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/transactions/orders/{order:invoice}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    Route::patch('/transactions/orders/{order:invoice}/payment', [OrderController::class, 'paymentProcess'])->name('orders.payment.process');
    Route::get('/transactions/orders/{order:invoice}/show', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/transactions/orders/{order:invoice}/receipt', [OrderController::class, 'receipt'])->name('orders.receipt');
    Route::get('/transactions/orders/{order:invoice}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

    Route::get('/transactions/orders/{order:invoice}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('/transactions/orders/{order:invoice}/update', [OrderController::class, 'update'])->name('orders.update');

    // Orders Custome
    Route::post('/transactions/orders/{order:invoice}/custom/store', [OrderController::class, 'orderCustomStore'])->name('orders.custom.store');
    Route::get('/transactions/orders/{order:invoice}/custom/create', [OrderController::class, 'orderCustomCreate'])->name('orders.custom.create');

    //Sales
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::get('/sales/{date}/show', [SalesController::class, 'show'])->name('sales.show');

    //Settlemtnt
    Route::get('/settlements/getNewCode', [SettlementController::class, 'getNewCode'])->name('settlements.getNewCode');
    Route::get('/settlements', [SettlementController::class, 'index'])->name('settlements');
    Route::get('/settlements/store', [SettlementController::class, 'store'])->name('settlements.store');
    Route::get('/settlements/{settlement:code}/show', [SettlementController::class, 'show'])->name('settlements.show');
    Route::get('/settlements/current', [SettlementController::class, 'current'])->name('settlements.current');
    Route::get('/settlements/{settlement:code}/edit', [SettlementController::class, 'edit'])->name('settlements.edit');
    Route::patch('/settlements/{settlement:code}/update', [SettlementController::class, 'update'])->name('settlements.update');

    // Ticket
    Route::get('/transactions/orders/ticket', [TicketController::class, 'index'])->name('orders.ticket');
    Route::post('/transactions/orders/ticket', [TicketController::class, 'store'])->name('orders.ticket.store');
    Route::get('/transactions/orders/{order:invoice}/ticket/show', [TicketController::class, 'show'])->name('orders.ticket.show');
    Route::get('/transactions/orders/{order:invoice}/ticket/create', [TicketController::class, 'create'])->name('orders.ticket.create');
    Route::get('/transactions/orders/{order:invoice}/ticket/{ticket:id}/update', [TicketController::class, 'update'])->name('orders.ticket.update');
    Route::get('/transactions/orders/{order:invoice}/ticket/{ticket:id}/getTicket', [TicketController::class, 'getTicket'])->name('orders.ticket.getTicket');
    Route::get('/transactions/orders/{order:invoice}/ticket/{ticket:id}/checkIn', [TicketController::class, 'update'])->name('orders.ticket.checkin');
    Route::get('/transactions/orders/ticket/validation', [TicketController::class, 'validation'])->name('orders.ticket.validation');
});

// ORDER ITEM
Route::get('/orders/{order:id}/product', [ItemController::class, 'productNotIn'])->name('orders.product.notIn');
Route::get('/orders/{order:id}/stock/update', [StockController::class, 'updateOrderStock'])->name('orders.stock.update');
Route::get('/orders/{order:id}/item', [ItemController::class, 'getItem'])->name('orders.items');
Route::get('/orders/{order:id}/item/store', [ItemController::class, 'store'])->name('orders.item.store');
Route::get('/orders/{order:id}/item/{item:id}/update', [ItemController::class, 'update'])->name('orders.item.update');
Route::get('/orders/{order:id}/item/{item:id}/plus', [ItemController::class, 'plus'])->name('orders.item.plus');
Route::get('/orders/{order:id}/item/{item:id}/min', [ItemController::class, 'min'])->name('orders.item.min');
Route::get('/orders/{order:id}/item/{item:id}/delete', [ItemController::class, 'delete'])->name('orders.item.delete');

// CUSTOMER CONTACT
Route::get('/dashboard/contacts', [ContactController::class, 'index'])->name('contacts');
