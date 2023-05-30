<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Sales;
use App\Models\SalesDetail;

class IssuedController extends Controller
{
    public function index(){
        //
        $issueddetail = DB::table('m_issued')
        ->leftJoin('m_issued_detail', 'm_issued_detail.IdIssued', '=', 'm_issued.IdIssued')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_issued_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_issued_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_issued_detail.IdIssuedDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_Issued_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_issued_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_issued_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_issued_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_issued.IdUser')
        ->where('m_Issued_detail.DeletedAt', '=', null)
        ->get();
            // dd($purchasingdetail);
    
            return view('issued.index', compact('issueddetail'));
    
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
       
       $buyer = DB::table('m_buyer')
       ->get();


        return view('issued.create', compact('product','departement','payment','suplier','unit','buyer'));

    }

    public function store(Request $request)
    {

        $user = DB::table('m_user')
        ->first();
        // dd($user);

        $sj = 'SJ-PHS';
        $bln = Date('m');
        $thn = Date('y');
        $codesales = Sales::where('CodeSales','like','%'. $bln.'/'.$thn)->count() + 1;
        if ($codesales < 10) {
            $codesales = '00' . $codesales;
        } else if ($codesales >= 10) {
            $codesales = '0' . $codesales;
        }
        // ship date = tgl kirim
        // so from
        // ship to
        $sales = new Sales();
        $sales->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $sales->CodeSales = $codesales.'/'.$sj.'/'.$bln.'/'.$thn;
        $sales->ShipDate = $request->ShipDate;
        $sales->SOFrom = $request->SOFrom;
        $sales->ShipTo = $request->ShipTo;
        $sales->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $sales->CreatedAt = Carbon::now();
        $sales->save();
        // dd($sales);

        foreach ($request->IdProduct as $key => $value){

            $dataharga = DB::table('m_harga')
        ->where('HargaSatuan', '=', $request->IdHarga[$key])
        ->first();

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
            $salesdetail->IdHarga = $dataharga->IdHarga;
            $salesdetail->Amount = $request->Amount[$key];
            $salesdetail->CreatedAt = Carbon::now();
            $salesdetail->save();
        }

        // dd($salesdetail);

        // return redirect('/sales/index')->with('success', 'Data Berhasil Ditambahkan');
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    function printissued($IdIssued){

        $detailissued = DB::table('m_issued')
        ->leftJoin('m_issued_detail', 'm_issued_detail.IdIssued', '=', 'm_issued.IdIssued')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_issued_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_issued_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_issued_detail.IdIssuedDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_Issued_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_issued_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_issued_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_issued_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_issued.IdUser')
        ->where('m_issued.IdIssued', '=', $IdIssued)
        ->first();
            // dd($detailsales);

            $detailIssued = DB::table('m_issued')
            ->leftJoin('m_issued_detail', 'm_issued_detail.IdIssued', '=', 'm_issued.IdIssued')
            ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_issued_detail.FROMIdDepartement')
            ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_issued_detail.TOIdDepartement')
            ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_issued_detail.IdIssuedDetail')
            ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_Issued_detail.IdSuplier')
            ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_issued_detail.IdProduct')
            ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_issued_detail.IdUnit')
            ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_issued_detail.IdHarga')
            ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_issued.IdUser')
            ->where('m_issued.IdIssued', '=', $IdIssued)
            ->get();
            // dd($detailSales);

            // $bom = Bom::find($IdSales);
            // dd($bom);

            $issued = Sales::find($IdIssued);
            // dd($sales);
            

        return view('issued.printissued', [
            'detailIssued' => $detailIssued,
            'detailissued' => $detailissued,
            'issued' => $issued,
            // 'bom' => $bom,
            // 'buyer' => $buyer
        ]);

    }
}
