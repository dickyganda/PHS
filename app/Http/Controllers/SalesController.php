<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SalesDetail;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan data sales detail
        $salesdetail = DB::table('m_sales_detail')->get();

        return view('sales.index', compact('salesdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // menampilkan form insert sales
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert sales
        $sales = new Sales;
        $sales->IdUserFK = 1;
        $sales->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $sales->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        $sales->CreatedBy = 'Dicky';
        $sales->CheckedBy = $request->input('CheckedBy');
        $sales->ApprovedBy = $request->input('ApprovedBy');
        $sales->DateRequired = $request->input('DateRequired');
        $sales->PaymentDate = $request->input('PaymentDate');
        $sales->IdPaymentFK = $request->input('IdPaymentFK');
        $sales->IdSuplierFK = $request->input('IdSuplierFK');
        $sales->CreatedAt = Date('Y-m-d');
        // $add->UpdatedAt = Date('Y-m-d');
        // $add->DeletedAt = $request->input('DeletedAt');
        $sales->save();
        // dd($add);

        // insert to tabel m_sales_detail
        foreach ($request->id_product as $key => $value){
        $add = new SalesDetail;
        $add->id_product = $value;
        $add->IdSalesFK = $sales->IdSales;
        $add->IdUnitFK = $request->input('IdUnitFK');
        $add->TOIdDepartementFK = $request->input('TOIdDepartementFK');
        $add->FROMIdDepartementFK = $request->input('FROMIdDepartementFK');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPaymentFK = $request->input('IdPaymentFK');
        $add->IdSuplierFK = $request->input('IdSuplierFK');
        $add->Qty = $request->input('IdSuplierFK');
        $add->Amount = $request->input('Amount');
        $add->CreatedAt = Date('Y-m-d');
        // $add->UpdatedAt = Date('Y-m-d');
        // $add->DeletedAt = $request->input('DeletedAt');
        $add->save();
        }

        return redirect()->route('sales.index')->with('success', 'Data Berhasil Disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($IdSalesDetail)
    {
        // menampilkan form edit sales
        $salesdetail = SalesDetail::findOrFail($IdSalesDetail);

        return view('sales.edit', compact('salesdetail'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $IdSalesDetail)
    {
        //
        // $salesdetail = SalesDetail::findOrFail($IdSalesDetail);
        DB::table('m_sales_detail')->where('IdSalesDetail',$request->IdSalesDetail)->update([
            'TOIdDepartementFK' => $request->TOIdDepartementFK,
            'FROMIdDepartementFK' => $request->FROMIdDepartementFK,
            'CheckedBy' => $request->CheckedBy,
            'ApprovedBy' => $request->ApprovedBy,
            'DateRequired' => $request->DateRequired,
            'PaymentDate' => $request->PaymentDate,
            'UpdatedAt' => Date('Y-m-d'),
            // 'IdPaymentFK' => $request->IdPaymentFK,
            // 'IdSuplierFK' => $request->IdSuplierFK,
        ]);

        // dd($request);

        return redirect()->route('sales.index')->with('success', 'Data Berhasil Diedit!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($IdSalesDetail)
    {
        // delete sales detail
        $salesdetail = SalesDetail::findOrFail($IdSalesDetail);
        $salesdetail->delete();

return redirect()->route('sales.index')->with('success', 'Data Berhasil Dihapus!');


}
}
