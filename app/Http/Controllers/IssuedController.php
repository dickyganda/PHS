<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Issued;
use App\Models\IssuedDetail;

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
        // $bln = Date('m');
        $array_bln = array(1=>"I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
        $bln = $array_bln[date('n')];
        $thn = Date('y');
        $codeissued = Issued::where('CodeIssued','like','%'. $bln.'/'.$thn)->count() + 1;
        if ($codeissued < 10) {
            $codeissued = '00' . $codeissued;
        } else if ($codeissued >= 10) {
            $codeissued = '0' . $codeissued;
        }
        // ship date = tgl kirim
        // so from
        // ship to
        $issued = new Issued();
        $issued->IdSales = $request->IdSales;
        $issued->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $issued->CodeIssued = $codeissued.'/'.$sj.'/'.$bln.'/'.$thn;
        $issued->ShipDate = $request->ShipDate;
        $issued->SOFrom = $request->SOFrom;
        $issued->DeliveredTo = $request->DeliveredTo;
        $issued->PreparedBy = $request->PreparedBy;
        $issued->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $issued->CreatedAt = Carbon::now();
        $issued->save();
        // dd($sales);

        foreach ($request->IdProduct as $key => $value){
            $dataharga = DB::table('m_harga')
        ->where('HargaSatuan', '=', $request->IdHarga[$key])
        ->first();

            $issueddetail = new IssuedDetail();
            $issueddetail->IdIssued = $issued->IdIssued;
            $issueddetail->IdProduct = $value;
            $issueddetail->IdUnit = $request->IdUnit[$key];
            $issueddetail->FROMIdDepartement = $request->FROMIdDepartement[$key];
            $issueddetail->TOIdDepartement = $request->TOIdDepartement[$key];
            $issueddetail->DateRequired = $request->DateRequired[$key];
            $issueddetail->PaymentDate = $request->PaymentDate[$key];
            $issueddetail->IdPayment = $request->IdPayment[$key];
            $issueddetail->IdSuplier = $request->IdSuplier[$key];
            $issueddetail->Qty = $request->Qty[$key];
            $issueddetail->IdHarga = $dataharga->IdHarga;
            $issueddetail->Amount = $request->Amount[$key];
            $issueddetail->CreatedAt = Carbon::now();
            $issueddetail->save();
        }

        // dd($salesdetail);

        // return redirect('/sales/index')->with('success', 'Data Berhasil Ditambahkan');
        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
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

    public function edit($IdIssuedDetail)
    {
        $issueddetail = DB::table('m_issued_detail')->where('IdIssuedDetail',$IdIssuedDetail)->get();

        $departement = DB::table('m_departement')
        ->get();

        return view('issued.edit', [
            'issueddetail' => $issueddetail,
            'departement' =>$departement,
        ]);

    }

    public function update(Request $request, $IdIssuedDetail)
{
    $user = DB::table('m_user')
        ->first();

        DB::table('m_issued')
        ->leftJoin('m_issued_detail', 'm_issued_detail.IdIssued', '=', 'm_issued.IdIssued')
        ->where('IdIssuedDetail',$IdIssuedDetail)->update([
		'm_issued_detail.FROMIdDepartement' => $request->FROMIdDepartement,
		'm_issued_detail.TOIdDepartement' => $request->TOIdDepartement,
		'm_issued_detail.CheckedBy' => $request->CheckedBy,
		'm_issued_detail.ApprovedBy' => $request->session()->get('IdUser', $user->IdUser),
        'm_issued.UpdatedAt' => Carbon::now(),
        'm_issued_detail.UpdatedAt' => Carbon::now(),
	]);

    // dd($request);

    return redirect('/issued/index')->with('success', 'Data Berhasil Diupdate');
    // return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function destroy($IdIssuedDetail)
{
    $issued_detail = DB::table('m_issued_detail')->where('IdIssuedDetail', $IdIssuedDetail);
        $id_issued = $issued_detail->first('IdIssued');
        $issued_detail->update([
            'DeletedAt' => Carbon::now(),
        ]);

    return redirect('/issued/index')->with('success', 'Data Berhasil Dihapus');
    
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

            $issued = Issued::find($IdIssued);
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
