<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\IssuedController;
use App\Http\Controllers\FinanceController;
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

Route::get('/sales/index', [SalesController::class, 'index'])->name('salesindex');
Route::get('/sales/create', [SalesController::class, 'create'])->name('salescreate');
Route::post('/sales/store', [SalesController::class, 'store'])->name('salesstore');
Route::get('/sales/edit/{IdSalesDetail}', [SalesController::class, 'edit'])->name('salesedit');
Route::put('/sales/update/{IdSalesDetail}', [SalesController::class, 'update'])->name('salesupdate');
Route::put('/sales/delete/{IdSalesDetail}', [SalesController::class, 'destroy'])->name('salesdestroy');
Route::post('/sales/getproduct', [SalesController::class, 'getproduct']);
Route::get('/sales/printsalesorder/{IdSales}', [SalesController::class, 'printsalesorder'])->name('salesprint');

Route::get('/bom/index', [BomController::class, 'index'])->name('bomindex');
Route::get('/bom/create', [BomController::class, 'create'])->name('bomcreate');
Route::post('/bom/store', [BomController::class, 'store'])->name('bomstore');
Route::get('/bom/edit/{IdBomDetail}', [BomController::class, 'edit'])->name('bomedit');
Route::put('/bom/update/{IdBomDetail}', [BomController::class, 'update'])->name('bomupdate');
Route::put('/bom/delete/{IdBomDetail}', [BomController::class, 'destroy'])->name('bomdestroy');

Route::get('/procurement/index', [ProcurementController::class, 'index'])->name('procurementindex');

Route::get('/purchasing/index', [PurchasingController::class, 'index'])->name('purchasingindex');
Route::get('/purchasing/create', [PurchasingController::class, 'create'])->name('purchasingcreate');
Route::post('/purchasing/store', [PurchasingController::class, 'store'])->name('purchasingstore');
Route::get('/purchasing/edit/{IdPurchasingDetail}', [PurchasingController::class, 'edit'])->name('purchasingedit');
Route::put('/purchasing/update/{IdPurchasingDetail}', [PurchasingController::class, 'update'])->name('purchasingupdate');
Route::put('/purchasing/delete/{IdPurchasingDetail}', [PurchasingController::class, 'destroy'])->name('purchasingdestroy');

Route::resource('/issued', IssuedController::class);

Route::resource('/finance', FinanceController::class);

