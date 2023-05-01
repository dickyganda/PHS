<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


use App\Models\Sales;
use App\Models\SalesDetail;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $salesdetail = DB::table('m_sales_detail')
        ->leftJoin('m_sales', 'm_sales.IdSales', '=', 'm_sales_detail.IdSales')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
        ->leftJoin('m_departement', 'm_departement.IdDepartement', '=', 'm_sales_detail.IdDepartement')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_sales.IdUser')
        ->get();
        // dd($salesdetail);

        // $salesdetail = DB::table('m_sales')
        //     ->leftJoin('m_sales_detail', 'm_sales_detail.IdSalesDetail', '=', 'm_sales.IdSales')
        //     ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
        //     ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        //     ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
        //     ->leftJoin('m_departement', 'm_departement.IdDepartement', '=', 'm_sales_detail.IdDepartement')
        //     ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
        //     ->where('IdSales', $IdSales)
        //     ->get();
            // dd($salesdetail);

        // $departement = DB::table('m_departement')
        // ->get();

        return view('sales.index', compact('salesdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
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

        // menampilkan form insert sales
        return view('sales.create', compact('product','departement','payment','suplier','unit'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $user = DB::table('m_user')
        // ->where('IdUser', '=', $request->IdUser)
        // ->get();
        // dd($user);

        Sales::create([
            'IdUser'     => Session::get('IdUser'),
            'FROMIdDepartement'   => $request->FROMIdDepartement,
            'TOIdDepartement'   => $request->TOIdDepartement,
            'CreatedBy'   => Session::get('IdUser'),
            'DateRequired'   => $request->DateRequired,
            'PaymentDate'   => $request->PaymentDate,
            'IdPaymment'   => $request->IdPaymment,
            'IdSuplier'   => $request->IdSuplier,
            'CreatedAt'   => Date('Y-m-d H:i:s'),
        ]);
        // dd($request);

        foreach($request->IdProduct as $key =>$value){
        SalesDetail::create([
            'IdSales'     => $request->IdSales,
            'IdProduct'   => $value,
            'IdUnit'   => $request->IdUnit[$key],
            'FROMIdDepartement'   => $request->FROMIdDepartement[$key],
            'TOIdDepartement'   => $request->TOIdDepartement[$key],
            'DateRequired'   => $request->DateRequired[$key],
            'PaymentDate'   => $request->PaymentDate[$key],
            'IdPayment'   => $request->IdPayment[$key],
            'IdSuplier'   => $request->IdSuplier[$key],
            'Qty'   => $request->Qty[$key],
            'IdHarga'   => $request->IdHarga[$key],
            // 'HargaProduct'   => $request->HargaProduct[$key],
            'Amount'   => $request->Amount[$key],
            'CreatedAt'   => Date('Y-m-d H:i:s'),
        ]);
    }
    // dd($request->HargaProduct[$key]);

    return redirect()->route('sales.index')->with('success', 'Data Berhasil Ditambahkan');

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
        //
        $salesdetail = SalesDetail::findOrFail($IdSalesDetail);
        // dd($salesdetail);

        return view('sales.edit', compact('salesdetail'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $IdSalesDetail)
    {
        //
        $salesdetail = SalesDetail::findOrFail($IdSalesDetail);
        $salesdetail->update($request->all());

        return redirect()->route('sales.index')->with('success', 'Data Berhasil Diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    public function printsalesorder($IdSales)
    {
        $detailSales = DB::table('m_sales')
            ->join('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
            ->join('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
            ->join('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
            ->join('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
            ->join('m_departement', 'm_departement.IdDepartement', '=', 'm_sales_detail.IdDepartement')
            ->join('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
            ->where('IdSales', $IdSales)
            ->get();

        return view('sales/printsalesorder', compact('detailSales'));
    }
}
