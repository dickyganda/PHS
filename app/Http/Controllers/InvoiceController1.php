<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Models\Sales;
use App\Models\SalesDetail;
use Illuminate\Support\Facades\Redirect;

class InvoiceController extends Controller
{
    //
    public function index(): View
    {
        // menampilkan data tabel m_sales_detail
        $SalesDetail = DB::table('m_sales_detail')->get();
        // dd($product);

        return view('invoice/salesorder/index', [
            'SalesDetail' => $SalesDetail
        ]);
    }

    function viewinsertsalesorder(){

        return view('/invoice/salesorder/insertsalesorder');
    }

    public function insertsales(Request $request): RedirectResponse
    {
        // insert to tabel m_sales
        $add = new Sales;
        $add->IdSales = $request->input('IdSales');
        $add->IdUserFK = $request->input('IdUserFK');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
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

        // insert to tabel m_sales_detail
        $add = new SalesDetail;
        $add->IdSalesDetail = $request->input('IdSalesDetail');
        $add->IdSalesFK = $request->input('IdSalesFK');
        $add->IdUserFK = $request->input('IdUserFK');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
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

    public function editsales($IdSalesDetail): View
{
	$SalesDetail = DB::table('m_sales_detail')->where('IdSalesDetail',$IdSalesDetail)->get();
    // dd($IdSalesDetail);

	return view('/invoice/salesorder/editsalesorder',['SalesDetail' => $SalesDetail]);

}

public function updatesales(Request $request)
{
    // $SalesDetail = SalesDetail::findOrFail($IdSalesDetail);
    // $SalesDetail->update($request->all());
	DB::table('m_sales_detail')->where('IdSalesDetail',$request->IdSalesDetail)->update([
		'TOIdDepartementFK' => $request->TOIdDepartementFK,
		'FROMIdDepartementFK' => $request->FROMIdDepartementFK,
		'CheckedBy' => $request->CheckedBy,
		'ApprovedBy' => $request->ApprovedBy,
		'DateRequired' => $request->DateRequired,
		'PaymentDate' => $request->PaymentDate,
		'IdPaymentFK' => $request->IdPaymentFK,
		'IdSuplierFK' => $request->IdSuplierFK,
	]);

    // dd($request);

    return redirect('invoice/salesorder/index');
    
}

    public function printsalesorder(): View
    {
        return view('invoice/salesorder/printsalesorder', [
            // 'user' => User::findOrFail($id)
        ]);
    }
}
