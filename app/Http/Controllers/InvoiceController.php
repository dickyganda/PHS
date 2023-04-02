<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

    public function insertsales(Request $request): View
    {
        $add = new Sales;
        $add->IdSales = $request->input('IdSales');
        $add->IdBomFK = $request->input('IdBomFK');
        $add->IdUserFK = $request->input('IdUserFK');
        $add->CodePurchasing = $request->input('CodePurchasing');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        $add->DatePurchasing = $request->input('DatePurchasing');
        $add->CreatedBy = $request->input('CreatedBy');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPaymentFK = $request->input('IdPaymentFK');
        $add->IdSuplierFK = $request->input('IdSuplierFK');
        $add->CreatedAt = $request->input('CreatedAt');
        $add->save();

        $add = new SalesDetail;
        $add->IdSales = $request->input('IdSales');
        $add->IdBomFK = $request->input('IdBomFK');
        $add->IdUserFK = $request->input('IdUserFK');
        $add->CodePurchasing = $request->input('CodePurchasing');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        $add->DatePurchasing = $request->input('DatePurchasing');
        $add->CreatedBy = $request->input('CreatedBy');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPaymentFK = $request->input('IdPaymentFK');
        $add->IdSuplierFK = $request->input('IdSuplierFK');
        $add->CreatedAt = $request->input('CreatedAt');
        $add->save();

        return view('invoice/salesorder/index', [
            // 'SalesDetail' => $SalesDetail
        ]);
    }

    public function printsalesorder(): View
    {
        return view('invoice/salesorder/printsalesorder', [
            // 'user' => User::findOrFail($id)
        ]);
    }
}
