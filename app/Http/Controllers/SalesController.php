<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Sales;
use App\Models\SalesDetail;
use App\Models\Bom;

class SalesController extends Controller
{
    //
    private $menuname = 'Sales';
    
    public function index()
    {
        // menampilkan data build of material
        $salesdetail = DB::table('m_sales')
        ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_sales_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_sales_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_sales_detail.IdSalesDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_sales_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_sales_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_sales_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_sales.IdUser')
        ->where('m_sales_detail.StatusDeleted', '=', 0)
        ->get();
        // dd($salesdetail);

        return view('sales.index', [
            'menuname' => $this->menuname,
            'salesdetail' =>$salesdetail
        ]);
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
       
       $buyerholding = DB::table('m_buyer_holding')
       ->get();


        return view('sales.create', compact('product','departement','payment','suplier','unit','buyerholding'));

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
        $so = 'SO-PHS';
        $thn = Date('y');
        $codesales = Sales::where('CodeSales','like','%'. $bln.'/'.$thn)->count() + 1;
        if ($codesales < 10) {
            $codesales = '00' . $codesales;
        } else if ($codesales >= 10) {
            $codesales = '0' . $codesales;
        }

        $sales = new Sales();
        $sales->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $sales->CodeSales = $codesales.'/'.$so.'/'.$bln.'/'.$thn;
        $sales->ShipDate = $request->ShipDate;
        $sales->SOFrom = $request->SOFrom;
        $sales->ShipTo = $request->ShipTo;
        $sales->StatusSales = 0;
        $sales->StatusChecked = 0;
        $sales->StatusApproved = 0;
        $sales->StatusDeleted = 0;
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
            // $salesdetail->StatusChecked = '0'[$key];
            // $salesdetail->StatusApproved = '0'[$key];
            $salesdetail->StatusDeleted = '0'[$key];
            $salesdetail->Amount = $request->Amount[$key];
            $salesdetail->CreatedAt = Carbon::now();
            $salesdetail->save();
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

    function printsalesorder($IdSales){

        $detailsales = DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom.IdBom', '=', 'm_bom_detail.IdBom')
        ->leftJoin('m_sales', 'm_bom.IdSales', '=', 'm_sales.IdSales')
        ->leftJoin('m_sales_detail', 'm_sales.IdSales', '=', 'm_sales_detail.IdSales')
        ->leftJoin('m_payment', 'm_sales_detail.IdPayment', '=', 'm_payment.IdPayment')
        ->leftJoin('m_suplier', 'm_sales_detail.IdSuplier', '=', 'm_suplier.IdSuplier')
        ->leftJoin('m_product', 'm_sales_detail.IdProduct', '=', 'm_product.IdProduct')
        ->leftJoin('m_unit', 'm_sales_detail.IdUnit', '=', 'm_unit.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_buyer_holding as buyerfrom', 'buyerfrom.IdBuyerHolding', '=', 'm_sales.SOFrom')
        ->leftJoin('m_buyer_holding as buyerto', 'buyerto.IdBuyerHolding', '=', 'm_sales.ShipTo')
        ->where('m_sales.IdSales', '=', $IdSales)
        ->first();
            // dd($detailsales);

        $detailSales = DB::table('m_bom')
        ->leftJoin('m_bom_detail', 'm_bom.IdBom', '=', 'm_bom_detail.IdBom')
        ->leftJoin('m_sales', 'm_bom.IdSales', '=', 'm_sales.IdSales')
        ->leftJoin('m_sales_detail', 'm_sales.IdSales', '=', 'm_sales_detail.IdSales')
        ->leftJoin('m_payment', 'm_sales_detail.IdPayment', '=', 'm_payment.IdPayment')
        ->leftJoin('m_suplier', 'm_sales_detail.IdSuplier', '=', 'm_suplier.IdSuplier')
        ->leftJoin('m_product', 'm_sales_detail.IdProduct', '=', 'm_product.IdProduct')
        ->leftJoin('m_unit', 'm_sales_detail.IdUnit', '=', 'm_unit.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_sales_detail.IdHarga')
        ->leftJoin('m_buyer_holding as buyerfrom', 'buyerfrom.IdBuyerHolding', '=', 'm_sales.SOFrom')
        ->leftJoin('m_buyer_holding as buyerto', 'buyerto.IdBuyerHolding', '=', 'm_sales.ShipTo')
        ->where('m_sales.IdSales', '=', $IdSales)
        ->get();
            // dd($detailSales);

            // $bom = Bom::find($IdSales);
            // dd($bom);

            $sales = Sales::find($IdSales);
            // dd($sales);
            

        return view('sales.printsalesorder', [
            'detailSales' => $detailSales,
            'detailsales' => $detailsales,
            'sales' => $sales,
            // 'bom' => $bom,
            // 'buyer' => $buyer
        ]);

    }

    public function edit($IdSalesDetail)
    {
        $departement = DB::table('m_departement')
        ->get();

        $unit = DB::table('m_unit')
        ->get();

        $salesdetail = DB::table('m_sales_detail')->where('IdSalesDetail',$IdSalesDetail)->get();

        return view('sales.edit', [
            'salesdetail' => $salesdetail,
            'departement' => $departement,
            'unit' => $unit
        ]);

    }

    public function update(Request $request, $IdSalesDetail)
{
    // $dataharga = DB::table('m_harga')
    //     ->where('HargaSatuan', '=', $request->IdHarga)
    //     ->first();

	DB::table('m_sales')
    ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
    ->where('IdSalesDetail',$IdSalesDetail)->update([
		'm_sales_detail.FROMIdDepartement' => $request->FROMIdDepartement,
		'm_sales_detail.TOIdDepartement' => $request->TOIdDepartement,
		'm_sales_detail.Qty' => $request->Qty,
		// 'm_sales_detail.Amount' => ($request->Qty * $dataharga->IdHarga),
		'm_sales_detail.IdUnit' => $request->IdUnit,
        'm_sales_detail.UpdatedAt' => Carbon::now(),
        'm_sales.UpdatedAt' => Carbon::now(),
	]);

    // dd($request);

    return redirect('/sales/index')->with('success', 'Data Berhasil Diupdate');
    // return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    
}

public function destroy($IdSalesDetail)
{
    $sales_detail = DB::table('m_sales')
    ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
    ->where('IdSalesDetail', $IdSalesDetail);
        $id_penjualan = $sales_detail->first('IdSales');
        $sales_detail->update([
            'DeletedAt' => Carbon::now(),
            'm_sales.StatusDeleted' => '1',
            'm_sales_detail.StatusDeleted' => '1'
        ]);

    return redirect('/sales/index')->with('success', 'Data Berhasil Dihapus');
    
}

public function checked(Request $request, $IdSales)
{
    $user = DB::table('m_user')
        ->first();

	DB::table('m_sales')
    ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
    ->where('m_sales.IdSales',$IdSales)->update([
		'm_sales.StatusCheckedSales' => 1,
		'm_sales.CheckedBy' => $request->session()->get('IdUser', $user->IdUser),
		'm_sales.UpdatedAt' => Carbon::now(),
		'm_sales_detail.UpdatedAt' => Carbon::now(),
	]);

    // dd($SalesChecked);

    return redirect('/sales/index')->with('success', 'Data Berhasil Diupdate');
    
}

public function approved(Request $request, $IdSales)
{
    $user = DB::table('m_user')
        ->first();

	DB::table('m_sales')
    ->leftJoin('m_sales_detail', 'm_sales_detail.IdSales', '=', 'm_sales.IdSales')
    ->where('m_sales.IdSales',$IdSales)->update([
		'm_sales.StatusApprovedSales' => 1,
		'm_sales.ApprovedBy' => $request->session()->get('IdUser', $user->IdUser),
		'm_sales.UpdatedAt' => Carbon::now(),
		'm_sales_detail.UpdatedAt' => Carbon::now(),
	]);

    // dd($SalesApproved);

    return redirect('/sales/index')->with('success', 'Data Berhasil Diupdate');
    
}
}
