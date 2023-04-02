<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Sales;
use App\Models\SalesDetail;

class InvoiceController extends Controller
{
    //
    public function index(): View
    {
        $SalesDetail = DB::table('m_sales_detail')->get();
        // dd($product);

        return view('invoice/salesorder/index', [
            'SalesDetail' => $SalesDetail
        ]);
    }

    function viewinsertsalesorder(){

        // memanggil view tambah warga
        return view('/invoice/salesorder/insertsalesorder');
    }

    public function insertsales(Request $request): RedirectResponse
    {
        $add = new Sales;
        $add->IdSales = $request->input('IdSales');
        // $add->IdBomFK = $request->input('IdBomFK');
        $add->IdUserFK = $request->input('IdUserFK');
        // $add->CodePurchasing = $request->input('CodePurchasing');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        // $add->DatePurchasing = $request->input('DatePurchasing');
        $add->CreatedBy = $request->input('CreatedBy');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPaymentFK = $request->input('IdPaymentFK');
        $add->IdSuplierFK = $request->input('IdSuplierFK');
        $add->CreatedAt = Date('Y-m-d');
        // $add->UpdatedAt = Date('Y-m-d');
        // $add->DeletedAt = $request->input('DeletedAt');
        $add->save();
        // dd($add);

        $add = new SalesDetail;
        $add->IdSalesDetail = $request->input('IdSalesDetail');
        $add->IdSalesFK = $request->input('IdSalesFK');
        // $add->IdBomFK = $request->input('IdBomFK');
        $add->IdUserFK = $request->input('IdUserFK');
        // $add->CodePurchasing = $request->input('CodePurchasing');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        // $add->DatePurchasing = $request->input('DatePurchasing');
        $add->CreatedBy = $request->input('CreatedBy');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPaymentFK = $request->input('IdPaymentFK');
        $add->IdSuplierFK = $request->input('IdSuplierFK');
        $add->CreatedAt = Date('Y-m-d');
        // $add->UpdatedAt = Date('Y-m-d');
        // $add->DeletedAt = $request->input('DeletedAt');
        $add->save();

        return redirect('invoice/salesorder/index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function printsalesorder(): View
    {
        return view('invoice/salesorder/printsalesorder', [
            // 'user' => User::findOrFail($id)
        ]);
    }
}
