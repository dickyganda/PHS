<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Warehouse;
use PhpParser\Node\Expr\AssignOp\Coalesce;

class WarehouseController extends Controller
{
    private $menuname = 'Warehouse';
    //
    public function index()
    {
        // menampilkan data build of material
        $warehouse = DB::table('m_warehouse')
        ->leftJoin('m_purchasing', 'm_purchasing.IdPurchasing', '=', 'm_warehouse.IdPurchasing')
        ->leftJoin('m_purchasing_detail', 'm_purchasing.IdPurchasing', '=', 'm_purchasing_detail.IdPurchasing')
        ->get();

        return view('warehouse.index', [
            'menuname' => $this->menuname,
            'warehouse' => $warehouse
        ]);
    }

    public function create()
    {
        
       // mengambil nama product
       $material = DB::table('m_material')
       ->get();

       $purchasing = DB::table('m_purchasing')
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
       
       $buyerholding = DB::table('m_buyer_holding')
       ->get();


        return view('warehouse.create', compact('departement','payment','suplier','unit','buyerholding','material','purchasing'));

    }

    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();

        // $qtypurchasing = DB::table('m_purchasing')
        // ->leftJoin('m_purchasing_detail', 'm_purchasing_detail.IdPurchasing', '=', 'm_purchasing.IdPurchasing')
        // ->select(DB::raw('sum(m_purchasing_detail.Qty) as Sisa'))
        // ->groupBy('m_purchasing.IdPurchasing')
        // ->first();

        
        // dd($qtypurchasing);

        $lastoutstanding = DB::table('m_purchasing')
        ->leftJoin('m_warehouse', 'm_warehouse.IdPurchasing', '=', 'm_purchasing.IdPurchasing')
        ->leftJoin('m_purchasing_detail', 'm_purchasing_detail.IdPurchasing', '=', 'm_purchasing.IdPurchasing')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_purchasing_detail.IdPurchasingDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_warehouse.IdSuplier')
        ->select(DB::raw('m_purchasing_detail.Qty - (COALESCE( sum( m_warehouse.IN ), 0 )) AS Outstanding, m_material.MaterialName '))
        ->where('m_purchasing.IdPurchasing', $request->IdPurchasing)
        // ->where('m_material.IdMaterial', $request->IdMaterial)
        ->groupBy('m_warehouse.IdPurchasing', 'm_warehouse.IdMaterial','m_purchasing_detail.qty','m_material.MaterialName')
        ->first();
        // dd($lastoutstanding);

        if(!empty($lastoutstanding) && $lastoutstanding->Outstanding < $request->In){
            return response()->json(array('status' => 'failed', 'reason' => 'kakehan'));
        }

        $warehouse = new Warehouse();
        $warehouse->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $warehouse->IdPurchasing = $request->IdPurchasing;
        $warehouse->IdSuplier = $request->IdSuplier;
        $warehouse->IdMaterial = $request->IdMaterial;
        $warehouse->In = $request->In;
        $warehouse->Out = $request->Out;
        $warehouse->StatusDeleted = 0;
        $warehouse->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $warehouse->CreatedAt = Carbon::now();
        $warehouse->save();
        // dd($sis);

        // return redirect('/sales/index')->with('success', 'Data Berhasil Ditambahkan');
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }
}
