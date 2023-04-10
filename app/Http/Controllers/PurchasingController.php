<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchasingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan data purchasing detail
        $purchasingdetail = DB::table('m_purchasing_detail')->get();

        return view('purchasing.index', compact('purchasingdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // mengambil data procurement
        $procurement = DB::table('m_procurement')->get();

        // mengambil code bom
        $bom = DB::table('m_bom')->get();

        // mengambil nama departement
        $departement = DB::table('m_departement')
        ->get();
        
        // mengambil nama payment
        $payment = DB::table('m_payment')
        ->get();
        
        // mengambil nama suplier
        $suplier = DB::table('m_suplier')
        ->get();
        
        // mengambil nama priority
        $priority = DB::table('m_priority')
        ->get();

        $material = DB::table('m_material')
        ->get();

        $unit = DB::table('m_unit')
        ->get();

        // menampilkan form insert purchasing
        return view('purchasing.create', compact('procurement','bom','departement','payment','suplier','priority','material','unit'));
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
