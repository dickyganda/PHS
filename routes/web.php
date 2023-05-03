<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\IssuedController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('auth/login');
});

// Route::controller(LoginRegisterController::class)->group(function() {
//     Route::get('/register', 'register')->name('register');
//     Route::post('/store', 'store')->name('store');
//     Route::get('/login', 'login')->name('login');
//     Route::post('/authenticate', 'authenticate')->name('authenticate');
//     Route::get('/dashboard', 'dashboard')->name('dashboard');
//     Route::post('/logout', 'logout')->name('logout');
// });

Route::controller(AuthController::class)->group(function() {
    // Route::get('/register', 'register')->name('register');
    // Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    // Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/sales/index', [SalesController::class, 'index']);
// Route::get('/sales/create', [SalesController::class, 'create']);
// Route::post('/sales/store', [SalesController::class, 'store']);
Route::get('/sales/edit/{IdSalesDetail}', [SalesController::class, 'edit']);
Route::post('/sales/getproduct', [SalesController::class, 'getproduct']);
Route::get('/sales/printsalesorder/{IdSales}', [SalesController::class, 'printsalesorder']);
// Route::post('/sales/update', [SalesController::class, 'update']);

// Route::get('/invoice/salesorder/index', [InvoiceController::class, 'index']);
// Route::get('/invoice/salesorder/viewinsertsalesorder', [InvoiceController::class, 'viewinsertsalesorder']);
// Route::post('/invoice/salesorder/insertsalesorder', [InvoiceController::class, 'insertsales']);
// Route::get('/invoice/salesorder/editsalesorder/{IdSalesDetail}', [InvoiceController::class, 'editsales']);
// Route::post('/invoice/salesorder/updatesalesorder', [InvoiceController::class, 'updatesales']);
// Route::get('/invoice/salesorder/printsalesorder', [InvoiceController::class, 'printsalesorder']);

// Route::resource('/sales', SalesController::class);
Route::get('/sales/index', [SalesController::class, 'index'])->name('salesindex');
Route::get('/sales/create', [SalesController::class, 'create'])->name('salescreate');
Route::post('/sales/store', [SalesController::class, 'store'])->name('salesstore');
Route::get('/sales/edit/{IdSalesDetail}', [SalesController::class, 'edit'])->name('salesedit');
Route::put('/sales/update/{IdSalesDetail}', [SalesController::class, 'update'])->name('salesupdate');
Route::post('/sales/delete/{IdSalesDetail}', [SalesController::class, 'delete'])->name('salesdelete');
Route::get('/sales/printsalesorder/{IdSales}', [SalesController::class, 'printsalesorder'])->name('salesprint');


Route::resource('/purchasing', PurchasingController::class);

// Route::resource('/sales', SalesController::class);

Route::resource('/issued', IssuedController::class);

Route::resource('/finance', FinanceController::class);

Route::get('/bom/index', [BomController::class, 'index'])->name('bomindex');
Route::get('/bom/create', [BomController::class, 'create'])->name('bomcreate');
Route::post('/bom/store', [BomController::class, 'store'])->name('bomstore');
Route::get('/bom/edit/{IdBomDetail}', [BomController::class, 'edit'])->name('bomedit');
Route::put('/bom/update/{IdBomDetail}', [BomController::class, 'update'])->name('bomupdate');
Route::post('/bom/delete/{IdBomDetail}', [BomController::class, 'destroy'])->name('bomdelete');
