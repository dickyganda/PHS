<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

Route::get('/invoice/salesorder/index', [InvoiceController::class, 'index']);
Route::get('/invoice/salesorder/printsalesorder', [InvoiceController::class, 'printsalesorder']);

