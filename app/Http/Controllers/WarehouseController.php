<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Warehouse;

class WarehouseController extends Controller
{
    private $menuname = 'Warehouse';
    //
    public function index()
    {
        // menampilkan data build of material
        $warehouse = DB::table('m_warehouse')
        ->leftJoin('m_purchasing', 'm_purchasing.IdPurchasing', '=', 'm_warehouse.IdPurchasing')
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
}
