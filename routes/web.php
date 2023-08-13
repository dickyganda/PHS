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
// use App\Http\Controllers\MenuController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\KasController;

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

Route::controller(AuthController::class)->group(function() {
    // Route::get('/register', 'register')->name('register');
    // Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    // Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

// Route::get('/layouts/sidebar', [MenuController::class, 'index'])->name('menu');

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/sales/index', [SalesController::class, 'index'])->name('salesindex');
Route::get('/sales/create', [SalesController::class, 'create'])->name('salescreate');
Route::post('/sales/store', [SalesController::class, 'store'])->name('salesstore');
Route::get('/sales/edit/{IdSalesDetail}', [SalesController::class, 'edit'])->name('salesedit');
Route::put('/sales/update/{IdSalesDetail}', [SalesController::class, 'update'])->name('salesupdate');
Route::put('/sales/delete/{IdSalesDetail}', [SalesController::class, 'destroy'])->name('salesdestroy');
Route::put('/sales/checked/{IdSales}', [SalesController::class, 'checked'])->name('saleschecked');
Route::put('/sales/approved/{IdSales}', [SalesController::class, 'approved'])->name('salesapproved');
Route::post('/sales/getproduct', [SalesController::class, 'getproduct']);
Route::get('/sales/printsalesorder/{IdSales}', [SalesController::class, 'printsalesorder'])->name('salesprint');

Route::get('/bom/index', [BomController::class, 'index'])->name('bomindex');
Route::get('/bom/create', [BomController::class, 'create'])->name('bomcreate');
Route::post('/bom/store', [BomController::class, 'store'])->name('bomstore');
Route::get('/bom/edit/{IdBomDetail}', [BomController::class, 'edit'])->name('bomedit');
Route::put('/bom/update/{IdBomDetail}', [BomController::class, 'update'])->name('bomupdate');
Route::put('/bom/delete/{IdBomDetail}', [BomController::class, 'destroy'])->name('bomdestroy');
Route::put('/bom/checked/{IdBom}', [BomController::class, 'checked'])->name('bomchecked');
Route::put('/bom/approved/{IdBom}', [BomController::class, 'approved'])->name('bomapproved');

// Route::get('/procurement/index', [ProcurementController::class, 'index'])->name('procurementindex');
// Route::get('/procurement/create', [ProcurementController::class, 'create'])->name('procurementcreate');
// Route::post('/procurement/store', [ProcurementController::class, 'store'])->name('procurementstore');
// Route::get('/procurement/edit/{IdProcurementDetail}', [ProcurementController::class, 'edit'])->name('procurementedit');
// Route::put('/procurement/update/{IdProcurementDetail}', [ProcurementController::class, 'update'])->name('procurementupdate');
// Route::put('/procurement/delete/{IdProcurementDetail}', [ProcurementController::class, 'destroy'])->name('procurementdestroy');

Route::get('/purchasing/index', [PurchasingController::class, 'index'])->name('purchasingindex');
Route::get('/purchasing/create', [PurchasingController::class, 'create'])->name('purchasingcreate');
Route::post('/purchasing/store', [PurchasingController::class, 'store'])->name('purchasingstore');
Route::get('/purchasing/edit/{IdPurchasingDetail}', [PurchasingController::class, 'edit'])->name('purchasingedit');
Route::put('/purchasing/update/{IdPurchasingDetail}', [PurchasingController::class, 'update'])->name('purchasingupdate');
Route::put('/purchasing/delete/{IdPurchasingDetail}', [PurchasingController::class, 'destroy'])->name('purchasingdestroy');
Route::put('/purchasing/checked/{IdPurchasing}', [PurchasingController::class, 'checked'])->name('purchasingchecked');
Route::put('/purchasing/approved/{IdPurchasing}', [PurchasingController::class, 'approved'])->name('purchasingapproved');
Route::get('/purchasing/printpurchasingorder/{IdPurchasing}', [PurchasingController::class, 'printpurchasingorder'])->name('purchasingprint');

Route::get('/issued/index', [IssuedController::class, 'index'])->name('issuedindex');
Route::get('/issued/create', [IssuedController::class, 'create'])->name('issuedcreate');
Route::post('/issued/store', [IssuedController::class, 'store'])->name('issuedstore');
Route::post('/issued/getproduct', [IssuedController::class, 'getproduct']);
Route::get('/issued/edit/{IdIssuedDetail}', [IssuedController::class, 'edit'])->name('issuededit');
Route::put('/issued/update/{IdIssuedDetail}', [IssuedController::class, 'update'])->name('issuedupdate');
Route::put('/issued/delete/{IdIssuedDetail}', [IssuedController::class, 'destroy'])->name('issueddestroy');
Route::put('/issued/checked/{IdIssued}', [IssuedController::class, 'checked'])->name('issuedchecked');
Route::put('/issued/approved/{IdIssued}', [IssuedController::class, 'approved'])->name('issuedapproved');
Route::get('/issued/printissued/{IdIssued}', [IssuedController::class, 'printissued'])->name('issuedprint');

Route::get('/finance/index', [FinanceController::class, 'index'])->name('financeindex');
Route::get('/finance/create', [FinanceController::class, 'create'])->name('financecreate');
Route::post('/finance/store', [FinanceController::class, 'store'])->name('financestore');
Route::post('/finance/getproduct', [FinanceController::class, 'getproduct']);
Route::get('/finance/edit/{IdInvoiceDetail}', [FinanceController::class, 'edit'])->name('financeedit');
Route::put('/finance/update/{IdInvoiceDetail}', [FinanceController::class, 'update'])->name('financeupdate');
Route::put('/finance/delete/{IdInvoiceDetail}', [FinanceController::class, 'destroy'])->name('financedestroy');
Route::put('/finance/checked/{IdInvoice}', [FinanceController::class, 'checked'])->name('financechecked');
Route::put('/finance/approved/{IdInvoice}', [FinanceController::class, 'approved'])->name('financeapproved');
Route::get('/finance/printinvoice/{IdInvoice}', [FinanceController::class, 'printissued'])->name('financeprint');

Route::get('/warehouse/index', [WarehouseController::class, 'index'])->name('warehouseindex');
Route::get('/warehouse/create', [WarehouseController::class, 'create'])->name('warehousecreate');
Route::post('/warehouse/store', [WarehouseController::class, 'store'])->name('financestore');
Route::get('/warehouse/edit/{IdWarehouse}', [WarehouseController::class, 'edit'])->name('warehouseedit');
Route::put('/warehouse/update/{IdWarehouse}', [WarehouseController::class, 'update'])->name('warehouseupdate');
Route::put('/warehouse/delete/{IdWarehouse}', [WarehouseController::class, 'destroy'])->name('warehousedestroy');

Route::get('/kas/index', [KasController::class, 'index'])->name('kasindex');
Route::get('/kas/create', [KasController::class, 'create'])->name('kascreate');
Route::post('/kas/store', [KasController::class, 'store'])->name('kasstore');
Route::put('/kas/delete/{IdKas}', [KasController::class, 'destroy'])->name('kasdestroy');
