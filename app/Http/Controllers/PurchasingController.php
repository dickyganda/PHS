<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Purchasing;
use App\Models\PurchasingDetail;

class PurchasingController extends Controller
{
    public function index(){
    //
    $purchasingdetail = DB::table('m_purchasing')
        ->leftJoin('m_purchasing_detail', 'm_purchasing_detail.IdPurchasing', '=', 'm_purchasing.IdPurchasing')
        ->leftJoin('m_bom', 'm_bom.IdBom', '=', 'm_purchasing.IdBom')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_purchasing.IdUser')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_purchasing.TOIdDepartement')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_purchasing.FROMIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_purchasing.IdPayment')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_purchasing.IdSuplier')
        ->leftJoin('m_priority', 'm_priority.IdPriority', '=', 'm_purchasing_detail.Priority')
        ->leftJoin('m_procurement', 'm_procurement.IdProcurement', '=', 'm_purchasing.IdProcurement')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_purchasing_detail.IdMaterial')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_purchasing_detail.Unit')
        ->where('m_purchasing_detail.DeletedAt', '=', null)
        ->get();
        // dd($purchasingdetail);

        return view('purchasing.index', compact('purchasingdetail'));

    }

    public function create()
    {
        // mengambil data bom
        $bom = DB::table('m_bom')
       ->get();

       // mengambil nama departement
       $departement = DB::table('m_departement')
       ->get();

       // mengambil nama product
       $product = DB::table('m_product')
       ->get();
       
       // mengambil nama payment
       $payment = DB::table('m_payment')
       ->get();
       
       // mengambil nama suplier
       $suplier = DB::table('m_suplier')
       ->get();
       
       $priority = DB::table('m_priority')
       ->get();

       $material = DB::table('m_material')
       ->get();

       $unit = DB::table('m_unit')
       ->get();

       $harga = DB::table('m_harga')
       ->get();

       $procurement = DB::table('m_procurement')
       ->get();

        return view('purchasing.create', compact('product','departement','payment','suplier','unit','priority','harga','procurement','material','bom'));

    }

    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();
        // dd($user);

        $po = 'PO';
        $tgl = date('d');
        $bln = date('m');

        // insert to tabel m_bom
        $purchasing = new Purchasing();
        $purchasing->IdProcurement = $request->IdProcurement;
        $purchasing->IdBom = $request->IdBom;
        $purchasing->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $purchasing->CodePurchasing = $po.$tgl.$bln;
        $purchasing->FROMIdDepartement = $request->FROMIdDepartement;
        $purchasing->TOIdDepartement = $request->TOIdDepartement;
        $purchasing->DatePurchasing = Carbon::now();
        $purchasing->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $purchasing->DateRequired = $request->DateRequired;
        $purchasing->PaymentDate = $request->PaymentDate;
        $purchasing->IdPayment = $request->IdPayment;
        $purchasing->IdSuplier = $request->IdSuplier;
        $purchasing->CreatedAt = Carbon::now();
        $purchasing->save();
        // dd($sales);

        foreach ($request->IdMaterial as $key => $value){
            $purchasingdetail = new PurchasingDetail();
            $purchasingdetail->IdPurchasing = $purchasing->IdPurchasing;
            $purchasingdetail->IdMaterial = $value;
            $purchasingdetail->Qty = $request->Qty[$key];
            // $salesdetail->IdUnit = $request->IdUnit[$key];
            $purchasingdetail->Unit = $request->Unit[$key];
            $purchasingdetail->Price = $request->Price[$key];
            $purchasingdetail->Total = $request->Total[$key];
            $purchasingdetail->Priority = $request->Priority[$key];
            $purchasingdetail->CreatedAt = Carbon::now();
            $purchasingdetail->save();
        }

        // dd($salesdetail);

        return redirect('/purchasing/index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($IdPurchasingDetail)
    {
        //
        $purchasingdetail = DB::table('m_purchasing')
        ->leftJoin('m_purchasing_detail', 'm_purchasing_detail.IdPurchasing', '=', 'm_Purchasing.IdPurchasing')
        ->leftJoin('m_procurement', 'm_procurement.IdProcurement', '=', 'm_purchasing.IdPurchasing')
        ->leftJoin('m_bom', 'm_bom.IdBom', '=', 'm_procurement.IdBom')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_purchasing.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_purchasing.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_purchasing.IdPayment')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_purchasing.IdSuplier')
        ->leftJoin('m_priority', 'm_priority.IdPriority', '=', 'm_purchasing_detail.IdPriority')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_purchasing_detail.Unit')
        ->leftJoin('m_material', 'm_material.IdMaterial', '=', 'm_purchasing_detail.IdMaterial')
        ->where('IdPurchasingDetail',$IdPurchasingDetail)->get();
        // dd($bomdetail);

        $priority = DB::table('m_priority')
        ->get();

        $unit = DB::table('m_unit')
        ->get();
        
        $payment = DB::table('m_payment')
        ->get();
        
        $suplier = DB::table('m_suplier')
        ->get();
        
        $departement = DB::table('m_departement')
        ->get();        

        $unit = DB::table('m_unit')
        ->get();

        return view('purchasing.edit', [
            'purchasingdetail' => $purchasingdetail,
            'priority' => $priority,
            'unit' => $unit,
            'payment' => $payment,
            'suplier' => $suplier,
            'departement' => $departement,
            'unit' => $unit,
              ]);

    }

    public function update(Request $request, $IdPurchasingDetail)
    {

        DB::table('m_purchasing')
        ->leftJoin('m_purchasing_detail', 'm_purchasing_detail.IdPurchasing', '=', 'm_purchasing.IdPurchasing')
        ->where('IdPurchasingDetail',$IdPurchasingDetail)->update([
            'TOIdDepartement' => $request->IdSbu,
            'FROMIdDepartement' => $request->IdHolding,
            'IdPayment' => $request->IdProduct,
            'IdSuplier' => $request->IdMaterial,
            // 'IdUnit' => $request->IdUnit,
            // 'Qty' => $request->Qty,
            // 'Price' => $request->Price,
            // 'm_bom.UpdatedAt' => date('Y-m-d h:i:s'),
            // 'm_bom_detail.UpdatedAt' => date('Y-m-d h:i:s')
        ]);

        // dd($request);

        return redirect('/bom/index')->with('success', 'Data Berhasil Diupdate');
    }

}
