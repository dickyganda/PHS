<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Sales;
use App\Models\SalesDetail;

class SalesController extends Controller
{
    //
    public function index()
    {
        // menampilkan data build of material

        $salesdetail = DB::table('m_sales')
        ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
        // ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_sales.IdUser')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
        ->leftJoin('m_departement', 'm_departement.IdDepartement', '=', 'm_sales_detail.IdDepartement')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
        ->where('m_sales_detail.DeletedAt', '=', null)
        ->get();
        // dd($salesdetail);

        return view('sales.index', compact('salesdetail'));
    }

    public function create()
    {
        
       // mengambil nama product
       $product = DB::table('m_product')
       // ->join('m_harga', 'm_harga.IdHarga', '=', 'm_product.IdHarga')
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

       $unit = DB::table('m_unit')
       ->get(); 


        return view('sales.create', compact('product','departement','payment','suplier','unit'));

    }

    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();
        // dd($user);

        // insert to tabel m_bom
        $sales = new Sales();
        $sales->IdUser = $request->session()->get('IdUser', $user->IdUser);
        // $sales->FROMIdDepartement = $request->FROMIdDepartement;
        // $sales->TOIdDepartement = $request->TOIdDepartement;
        $sales->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        // $sales->DateRequired = $request->DateRequired;
        // $sales->PaymentDate = $request->PaymentDate;
        // $sales->IdPayment = $request->IdPayment;
        // $sales->IdSuplier = $request->PaymentDate;
        $sales->CreatedAt = Carbon::now();
        $sales->save();
        // dd($sales);

        foreach ($request->IdProduct as $key => $value){
            $salesdetail = new SalesDetail();
            $salesdetail->IdSales = $sales->IdSales;
            $salesdetail->IdProduct = $value;
            $salesdetail->IdUnit = $request->IdUnit[$key];
            $salesdetail->FROMIdDepartement = $request->FROMIdDepartement[$key];
            $salesdetail->TOIdDepartement = $request->TOIdDepartement[$key];
            $salesdetail->DateRequired = $request->DateRequired[$key];
            $salesdetail->PaymentDate = $request->PaymentDate[$key];
            $salesdetail->IdPayment = $request->IdPayment[$key];
            $salesdetail->IdSuplier = $request->IdSuplier[$key];
            $salesdetail->Qty = $request->Qty[$key];
            $salesdetail->IdHarga = $request->IdHarga[$key];
            $salesdetail->Amount = $request->Amount[$key];
            $salesdetail->CreatedAt = Carbon::now();
            $salesdetail->save();
        }

        // dd($salesdetail);

        return redirect('/sales/index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function getproduct(Request $request)
    {
        //
        $getproduct = DB::table('m_product')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_product.IdHarga')
        ->where('IdProduct', $request->input('IdProduct'))->first();
        // dd($getproduct);

        return response()->json($getproduct);
    }

    function printsalesorder($IdSales){

        $detailSales = DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom.IdBom', '=', 'm_bom_detail.IdBom')
        ->leftJoin('m_sales', 'm_bom.IdSales', '=', 'm_sales.IdSales')
        ->leftJoin('m_sales_detail', 'm_sales.IdSales', '=', 'm_sales_detail.IdSales')
        ->leftJoin('m_payment', 'm_sales_detail.IdPayment', '=', 'm_payment.IdPayment')
        ->leftJoin('m_suplier', 'm_sales_detail.IdSuplier', '=', 'm_suplier.IdSuplier')
        ->leftJoin('m_product', 'm_sales_detail.IdProduct', '=', 'm_product.IdProduct')
        ->leftJoin('m_unit', 'm_sales_detail.IdUnit', '=', 'm_unit.IdUnit')
        ->where('m_sales.IdSales', '=', $IdSales)
        ->get();
            // dd($detailSales);

            // $sales = Sales::find($IdSales);
            // dd($sales);

        return view('sales.printsalesorder', [
            'detailSales' => $detailSales,
            // 'sales' => $sales
        ]);

    }

    public function edit($IdSalesDetail)
    {
        //
        // $salesdetail = SalesDetail::findOrFail($IdSalesDetail);
        // dd($salesdetail);
        $salesdetail = DB::table('m_sales_detail')->where('IdSalesDetail',$IdSalesDetail)->get();

        return view('sales.edit', [
            'salesdetail' => $salesdetail
        ]);

    }

    public function update(Request $request, $IdSalesDetail)
{
	DB::table('m_sales_detail')->where('IdSalesDetail',$IdSalesDetail)->update([
		'FROMIdDepartement' => $request->FROMIdDepartement,
		'TOIdDepartement' => $request->TOIdDepartement,
		'CheckedBy' => $request->CheckedBy,
		'ApprovedBy' => $request->ApprovedBy,
	]);

    // $salesdetail = SalesDetail::findOrFail($IdSalesDetail);

    // $salesdetail->update([
    //     'FROMIdDepartement' => request('FROMIdDepartement'),
    //     'TOIdDepartement' => request('TOIdDepartement'),
    //     'CheckedBy' => request('CheckedBy'),
    // ]);

    // dd($request);

    return redirect('/sales/index')->with('success', 'Data Berhasil Diupdate');
    
}

public function delete($IdSalesDetail)
{
	DB::table('m_sales_detail')->where('IdSalesDetail',$IdSalesDetail)->update([
		'DeletedAt' => Carbon::now(),
    ]);

    return redirect('/sales/index')->with('success', 'Data Berhasil Diupdate');
    
}

}
