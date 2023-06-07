<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Bom;
use App\Models\BomDetail;


class BomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // menampilkan data build of material
        $bomdetail = DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom_detail.IdBom', '=', 'm_bom.IdBom')
        ->leftJoin('m_sbu', 'm_sbu.IdSbu', '=', 'm_bom.IdSbu')
        ->leftJoin('m_holding', 'm_holding.IdHolding', '=', 'm_bom.IdHolding')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_bom.IdProduct')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_bom_detail.IdMaterial')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_bom_detail.IdUnit')
        ->where('m_bom_detail.DeletedAt', '=', null)
        ->get();
        // dd($bomdetail);

        return view('bom.index', compact('bomdetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = DB::table('m_sales')
        ->where('StatusSales', '=', 0)
        ->get();

        // mengambil nama product
        $material = DB::table('m_material')
        ->get();
        
        // mengambil nama departement
        $sbu = DB::table('m_sbu')
        ->get();
        
        // mengambil nama payment
        $holding = DB::table('m_holding')
        ->get();
        
        // mengambil nama suplier
        $product = DB::table('m_product')
        ->get();        

        $unit = DB::table('m_unit')
        ->get();

        return view('bom.create', compact('sales','material','sbu','holding','product','unit'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();

        $product = DB::table('m_product')
        ->first();
        // dd($user);
        $initproduct = $product->CodeProduct; //max 5 char
        $bln = Date('m');
        $tgl = Date('d');
        
        // insert to tabel m_bom
        $bom = new Bom();
        $bom->IdSales = $request->IdSales;
        $bom->BomCode = $initproduct.$tgl.$bln;
        $bom->BomDate = Carbon::now();
        $bom->IdSbu = $request->IdSbu;
        $bom->IdHolding = $request->IdHolding;
        $bom->IdProduct = $request->IdProduct;
        $bom->CreatedAt = Carbon::now();
        $bom->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $bom->save();
        // dd($bom);

        foreach ($request->IdMaterial as $key => $value){
            $bomdetail = new BomDetail();
            $bomdetail->IdBom = $bom->IdBom;
            $bomdetail->IdMaterial = $value;
            $bomdetail->Qty = $request->Qty[$key];
            $bomdetail->Price = $request->Price[$key];
            $bomdetail->IdUnit = $request->IdUnit[$key];
            $bomdetail->CreatedAt = Carbon::now();
            $bomdetail->save();
        }

        DB::table('m_sales')
        ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
        ->where('IdSalesDetail',$request->IdSalesDetail)->update([
            'm_sales.StatusSales' => 1,
            'm_sales.UpdatedAt' => Carbon::now(),
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
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
    public function edit($IdBomDetail)
    {
        //
        $bomdetail = DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom_detail.IdBom', '=', 'm_bom.IdBom')
        ->leftJoin('m_sbu', 'm_sbu.IdSbu', '=', 'm_bom.IdSbu')
        ->leftJoin('m_holding', 'm_holding.IdHolding', '=', 'm_bom.IdHolding')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_bom.IdProduct')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_bom_detail.IdMaterial')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_bom_detail.IdUnit')
        ->where('IdBomDetail',$IdBomDetail)->get();
        // dd($bomdetail);

        // mengambil nama product
        $material = DB::table('m_material')
        ->get();
        
        // mengambil nama departement
        $sbu = DB::table('m_sbu')
        ->get();
        
        // mengambil nama payment
        $holding = DB::table('m_holding')
        ->get();
        
        // mengambil nama suplier
        $product = DB::table('m_product')
        ->get();        

        $unit = DB::table('m_unit')
        ->get();

        return view('bom.edit', [
            'bomdetail' => $bomdetail,
            'sbu' => $sbu,
            'material' => $material,
            'holding' => $holding,
            'product' => $product,
            'unit' => $unit
              ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $IdBomDetail)
    {

        DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom_detail.IdBom', '=', 'm_bom.IdBom')
        ->where('IdBomDetail',$IdBomDetail)->update([
            'm_bom.IdSbu' => $request->IdSbu,
            'm_bom.IdHolding' => $request->IdHolding,
            'm_bom_detail.IdUnit' => $request->IdUnit,
            'm_bom_detail.Qty' => $request->Qty,
            'm_bom_detail.Price' => $request->Price,
            'm_bom.UpdatedAt' => Carbon::now(),
            'm_bom_detail.UpdatedAt' => Carbon::now(),
        ]);

        // dd($request);

        return redirect('/bom/index')->with('success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($IdBomDetail)
    {
        //
        $bom_detail = DB::table('m_bom_detail')->where('IdBomDetail', $IdBomDetail);
        $id_penjualan = $bom_detail->first('IdBom');
        $bom_detail->update([
            'DeletedAt' => Carbon::now()
        ]);

        return redirect('/bom/index')->with('success', 'Data Berhasil Dihapus');
    }
}
