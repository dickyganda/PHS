<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $financedetail = DB::table('m_sales')
        ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_sales_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_sales_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_sales_detail.IdSalesDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_sales.IdUser')
        ->where('m_sales_detail.DeletedAt', '=', null)
        ->get();

        return view('finance.index', compact('financedetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
