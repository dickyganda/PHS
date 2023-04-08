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
        $salesdetail = DB::table('m_sales_detail')
        ->join('m_sales', 'm_sales.IdSales', '=', 'm_sales_detail.IdSales')
        ->get();

        // dd($salesdetail);

        return view('sales.index', compact('salesdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // mengambil nama product
        $product = DB::table('m_product')
        ->join('m_harga', 'm_harga.IdHarga', '=', 'm_product.IdHarga')
        ->get();
        
        // mengambil nama departement
        $departement = DB::table('m_departement')
        ->get();
        
        // mengambil nama payment
        $payment = DB::table('m_payment')
        ->get();
        
        // mengambil nama suplier
        $suplier = DB::table('m_suplier')
        ->get();        
        // dd($payment);

        // menampilkan form insert sales
        return view('sales.create', compact('product','departement','payment','suplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert sales
        $sales = new Sales;
        $sales->IdUser = 1;
        $sales->TOIdDepartement = $request->input('TOIdDepartement');
        $sales->FROMIdDepartement = $request->input('FROMIdDepartement');
        $sales->CreatedBy = 'Dicky';
        $sales->CheckedBy = $request->input('CheckedBy');
        $sales->ApprovedBy = $request->input('ApprovedBy');
        $sales->DateRequired = $request->input('DateRequired');
        $sales->PaymentDate = $request->input('PaymentDate');
        $sales->IdPayment = $request->input('IdPayment');
        $sales->IdSuplier = $request->input('IdSuplier');
        $sales->CreatedAt = Date('Y-m-d');
        // $add->UpdatedAt = Date('Y-m-d');
        // $add->DeletedAt = $request->input('DeletedAt');
        $sales->save();
        // dd($add);

        // insert to tabel m_sales_detail
        foreach ($request->id_product as $key => $value){
        $add = new SalesDetail;
        $add->IdProduct = $value;
        $add->IdSales = $sales->IdSales;
        $add->IdUnit = $request->input('IdUnit');
        $add->TOIdDepartement = $request->input('TOIdDepartement');
        $add->FROMIdDepartement = $request->input('FROMIdDepartement');
        $add->CheckedBy = $request->input('CheckedBy');
        $add->ApprovedBy = $request->input('ApprovedBy');
        $add->DateRequired = $request->input('DateRequired');
        $add->PaymentDate = $request->input('PaymentDate');
        $add->IdPayment = $request->input('IdPayment');
        $add->IdSuplier = $request->input('IdSuplier');
        $add->Qty = $request->input('Qty');
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
