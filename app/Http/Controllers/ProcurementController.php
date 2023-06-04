<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Procurement;
use App\Models\ProcurementDetail;

class ProcurementController extends Controller
{
    //
    public function index()
    {
        // menampilkan data build of material

        $procurementdetail = DB::table('m_procurement')
        ->leftJoin('m_procurement_detail', 'm_procurement_detail.IdProcurement', '=', 'm_procurement.IdProcurement')
        ->leftJoin('m_bom', 'm_bom.IdBom', '=', 'm_procurement.IdBom')
        ->leftJoin('m_departement as fromdep', 'fromdep.IdDepartement', '=', 'm_procurement.FROMIdDepartement')
        ->leftJoin('m_departement as todep', 'todep.IdDepartement', '=', 'm_procurement.TOIdDepartement')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_procurement.IdUser')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_procurement_detail.IdMaterial')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_procurement_detail.Unit')
        ->where('m_procurement_detail.DeletedAt', '=', null)
        ->get();
        // dd($bomdetail);

        return view('procurement.index', compact('procurementdetail'));
    }

    public function create()
    {
        // mengambil data bom
        $bom = DB::table('m_bom')
       ->get();

       // mengambil nama departement
       $departement = DB::table('m_departement')
       ->get();
       
       // mengambil nama payment
       $material = DB::table('m_material')
       ->get();
       
       // mengambil nama suplier
       $unit = DB::table('m_unit')
       ->get();
       
        return view('procurement.create', compact('bom','departement','material','unit'));

    }

    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();
        // dd($user);

        // insert to tabel m_bom
        // kode sale = inc/ so-phs/bln/thn
        // $increment = 1;
        // $increment++; //reset per bulan
        $array_bln = array(1=>"I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
        $bln = $array_bln[date('n')];
        // $bln = Date('m');
        $thn = Date('y');
        $phs = 'SO-PHS';
        $codeprocurement = Procurement::where('CodeProcurement','like','%'. $bln.'/'.$thn)->count() + 1;
        if ($codeprocurement < 10) {
            $codeprocurement = '00' . $codeprocurement;
        } else if ($codeprocurement >= 10) {
            $codeprocurement = '0' . $codeprocurement;
        }
        // ship date = tgl kirim
        // so from
        // ship to
        $procurement = new Procurement();
        $procurement->IdBom = $request->IdBom;
        $procurement->CodeProcurement = $codeprocurement.'/'.$phs.'/'.$bln.'/'.$thn;
        $procurement->FROMIdDepartement = $request->FROMIdDepartement;
        $procurement->TOIdDepartement = $request->TOIdDepartement;
        $procurement->DateProcurement = Carbon::now();
        $procurement->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $procurement->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $procurement->CreatedAt = Carbon::now();
        $procurement->DateRequired = $request->DateRequired;
        $procurement->save();
        // dd($sales);

        foreach ($request->IdMaterial as $key => $value){
            $procurementdetail = new ProcurementDetail();
            $procurementdetail->IdProcurement = $procurement->IdProcurement;
            $procurementdetail->IdMaterial = $value;
            $procurementdetail->Qty = $request->Qty[$key];
            $procurementdetail->Unit = $request->Unit[$key];
            $procurementdetail->Price = $request->Price[$key];
            $procurementdetail->Total = $request->Total[$key];
            $procurementdetail->CreatedAt = Carbon::now();
            $procurementdetail->save();
        }

        // dd($salesdetail);

        // return redirect('/sales/index')->with('success', 'Data Berhasil Ditambahkan');
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function edit($IdProcurementDetail)
    {
        $procurementdetail = DB::table('m_procurement_detail')->where('IdProcurementDetail',$IdProcurementDetail)->get();

        $material = DB::table('m_material')
        ->get();

        $unit = DB::table('m_unit')
        ->get();

        return view('procurement.edit', [
            'procurementdetail' => $procurementdetail,
            'material' => $material,
            'unit' => $unit,
        ]);

    }

    public function update(Request $request, $IdProcurementDetail)
    {

        DB::table('m_procurement')
        ->leftJoin('m_procurement_detail', 'm_procurement_detail.IdProcurement', '=', 'm_procurement.IdProcurement')
        ->where('IdProcurementDetail',$IdProcurementDetail)->update([
            'IdMaterial' => $request->IdMaterial,
            'Unit' => $request->Unit,
            'Qty' => $request->Qty,
            'Price' => $request->Price,
            'Total' => ($request->Price * $request->Qty),
            'm_procurement.UpdatedAt' => Carbon::now(),
            'm_procurement_detail.UpdatedAt' => Carbon::now(),
        ]);

        // dd($request);

        return redirect('/procurement/index')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($IdProcurementDetail)
    {

        $procurement_detail = DB::table('m_procurement_detail')->where('IdProcurementDetail', $IdProcurementDetail);
        $id_penjualan = $procurement_detail->first('IdProcurement');
        $procurement_detail->update([
            'DeletedAt' => Carbon::now(),
        ]);

        return redirect('/procurement/index')->with('success', 'Data Berhasil Dihapus');
    }
}
