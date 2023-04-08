<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchasingController;
use App\Http\Controllers\IssuedController;
use App\Http\Controllers\FinanceController;

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
    return view('dashboard/index');
});

Route::get('/dashboard/index', [DashboardController::class, 'index']);

// Route::get('/invoice/salesorder/index', [InvoiceController::class, 'index']);
// Route::get('/invoice/salesorder/viewinsertsalesorder', [InvoiceController::class, 'viewinsertsalesorder']);
// Route::post('/invoice/salesorder/insertsalesorder', [InvoiceController::class, 'insertsales']);
// Route::get('/invoice/salesorder/editsalesorder/{IdSalesDetail}', [InvoiceController::class, 'editsales']);
// Route::post('/invoice/salesorder/updatesalesorder', [InvoiceController::class, 'updatesales']);
// Route::get('/invoice/salesorder/printsalesorder', [InvoiceController::class, 'printsalesorder']);

Route::resource('/sales', SalesController::class);

Route::resource('/purchasing', PurchasingController::class);

Route::resource('/issued', IssuedController::class);

Route::resource('/finance', FinanceController::class);
