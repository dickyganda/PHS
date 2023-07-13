<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceDetail;

class FinanceController extends Controller
{
    private $menuname = 'Finance';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $financedetail = DB::table('m_invoice')
        ->leftJoin('m_invoice_detail', 'm_invoice_detail.IdInvoice', '=', 'm_invoice.IdInvoice')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_invoice_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_invoice_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_invoice_detail.IdInvoiceDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_invoice_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_invoice_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_invoice_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_invoice_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_invoice.IdUser')
        ->leftJoin('m_sales', 'm_sales.IdSales', '=', 'm_invoice.IdSales')
        ->leftJoin('m_issued', 'm_issued.IdIssued', '=', 'm_invoice.IdIssued')
        ->where('m_invoice_detail.StatusDeleted', '=', 0)
        ->get();

        return view('finance.index', [
            'menuname' => $this->menuname,
            'financedetail' => $financedetail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

       $sales = DB::table('m_sales')
        ->where([
            ['StatusSales', '=', '0'],
        ['StatusDeleted', '=', '0'],
        ])
        ->get();

       $issued = DB::table('m_issued')
       ->get();

       return view('finance.create', compact('product','departement','payment','suplier','unit','buyerholding','sales','issued'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = DB::table('m_user')
        ->first();
        // dd($user);

        $sj = 'INV-PHS';
        // $bln = Date('m');
        $array_bln = array(1=>"I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");
        $bln = $array_bln[date('n')];
        $thn = Date('y');
        $codeinvoice = Invoice::where('CodeInvoice','like','%'. $bln.'/'.$thn)->count() + 1;
        if ($codeinvoice < 10) {
            $codeinvoice = '00' . $codeinvoice;
        } else if ($codeinvoice >= 10) {
            $codeinvoice = '0' . $codeinvoice;
        }
        // ship date = tgl kirim
        // so from
        // ship to
        $invoice = new Invoice();
        $invoice->IdSales = $request->IdSales;
        $invoice->IdIssued = $request->IdIssued;
        $invoice->IdUser = $request->session()->get('IdUser', $user->IdUser);
        $invoice->CodeInvoice = $codeinvoice.'/'.$sj.'/'.$bln.'/'.$thn;
        $invoice->ShipDate = $request->ShipDate;
        $invoice->SOFrom = $request->SOFrom;
        $invoice->InvoiceTo = $request->InvoiceTo;
        $invoice->DueDate = $request->DueDate;
        $invoice->StatusDeleted = 0;
        $invoice->CreatedBy = $request->session()->get('IdUser', $user->IdUser);
        $invoice->CreatedAt = Carbon::now();
        $invoice->save();
        // dd($sales);

        foreach ($request->IdProduct as $key => $value){
            $dataharga = DB::table('m_harga')
        ->where('HargaSatuan', '=', $request->IdHarga[$key])
        ->first();

            $invoicedetail = new InvoiceDetail();
            $invoicedetail->IdInvoice = $invoice->IdInvoice;
            $invoicedetail->IdProduct = $value;
            $invoicedetail->IdUnit = $request->IdUnit[$key];
            $invoicedetail->FROMIdDepartement = $request->FROMIdDepartement[$key];
            $invoicedetail->TOIdDepartement = $request->TOIdDepartement[$key];
            $invoicedetail->DateRequired = $request->DateRequired[$key];
            $invoicedetail->PaymentDate = $request->PaymentDate[$key];
            $invoicedetail->IdPayment = $request->IdPayment[$key];
            $invoicedetail->IdSuplier = $request->IdSuplier[$key];
            $invoicedetail->Qty = $request->Qty[$key];
            $invoicedetail->IdHarga = $dataharga->IdHarga;
            $invoicedetail->Amount = $request->Amount[$key];
            $invoicedetail->StatusDeleted = '0'[$key];
            $invoicedetail->CreatedAt = Carbon::now();
            $invoicedetail->save();
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
    public function edit($IdInvoiceDetail)
    {
        //
        $invoicedetail = DB::table('m_invoice_detail')->where('IdInvoiceDetail',$IdInvoiceDetail)->get();

        $departement = DB::table('m_departement')
        ->get();

        return view('finance.edit', [
            'invoicedetail' => $invoicedetail,
            'departement' =>$departement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $IdInvoiceDetail)
    {
        //
        $user = DB::table('m_user')
        ->first();

        DB::table('m_invoice')
        ->leftJoin('m_invoice_detail', 'm_invoice_detail.IdInvoice', '=', 'm_invoice.IdInvoice')
        ->where('IdInvoiceDetail',$IdInvoiceDetail)->update([
		'm_invoice_detail.FROMIdDepartement' => $request->FROMIdDepartement,
		'm_invoice_detail.TOIdDepartement' => $request->TOIdDepartement,
		// 'm_issued_detail.CheckedBy' => $request->CheckedBy,
		// 'm_issued_detail.ApprovedBy' => $request->session()->get('IdUser', $user->IdUser),
        'm_invoice.UpdatedAt' => Carbon::now(),
        'm_invoice_detail.UpdatedAt' => Carbon::now(),
	]);

    // dd($request);

    return redirect('/finance/index')->with('success', 'Data Berhasil Diupdate');
    // return response()->json(array('status'=> 'success', 'reason' => 'Sukses Edit Data'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($IdInvoiceDetail)
    {
        //
        $invoice_detail = DB::table('m_invoice_detail')->where('IdInvoiceDetail', $IdInvoiceDetail);
        $id_invoice = $invoice_detail->first('IdInvoice');
        $invoice_detail->update([
            'DeletedAt' => Carbon::now(),
            'StatusDeleted' => 1,
        ]);

    return redirect('/finance/index')->with('success', 'Data Berhasil Dihapus');
    }

    function printissued($IdInvoice){

        $detailinvoice = DB::table('m_invoice')
        ->leftJoin('m_invoice_detail', 'm_invoice_detail.IdInvoice', '=', 'm_invoice.IdInvoice')
        ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_invoice_detail.FROMIdDepartement')
        ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_invoice_detail.TOIdDepartement')
        ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_invoice_detail.IdInvoiceDetail')
        ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_invoice_detail.IdSuplier')
        ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_invoice_detail.IdProduct')
        ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_invoice_detail.IdUnit')
        ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_invoice_detail.IdHarga')
        ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_invoice.IdUser')
        ->leftJoin('m_sales', 'm_sales.IdSales', '=', 'm_invoice.IdSales')
        ->leftJoin('m_issued', 'm_issued.IdIssued', '=', 'm_invoice.IdIssued')
        ->where('m_invoice.IdInvoice', '=', $IdInvoice)
        ->first();
            // dd($detailsales);

            $detailInvoice = DB::table('m_invoice')
            ->leftJoin('m_invoice_detail', 'm_invoice_detail.IdInvoice', '=', 'm_invoice.IdInvoice')
            ->leftJoin('m_departement as depfrom', 'depfrom.IdDepartement', '=', 'm_invoice_detail.FROMIdDepartement')
            ->leftJoin('m_departement as depto', 'depto.IdDepartement', '=', 'm_invoice_detail.TOIdDepartement')
            ->leftJoin('m_payment', 'm_payment.IdPayment', '=', 'm_invoice_detail.IdInvoiceDetail')
            ->leftJoin('m_suplier', 'm_suplier.IdSuplier', '=', 'm_invoice_detail.IdSuplier')
            ->leftJoin('m_product', 'm_product.IdProduct', '=', 'm_invoice_detail.IdProduct')
            ->leftJoin('m_unit', 'm_unit.IdUnit', '=', 'm_invoice_detail.IdUnit')
            ->leftJoin('m_harga', 'm_harga.IdHarga', '=', 'm_invoice_detail.IdHarga')
            ->leftJoin('m_user', 'm_user.IdUser', '=', 'm_invoice.IdUser')
            ->leftJoin('m_sales', 'm_sales.IdSales', '=', 'm_invoice.IdSales')
            ->leftJoin('m_issued', 'm_issued.IdIssued', '=', 'm_invoice.IdIssued')
            ->where('m_invoice.IdInvoice', '=', $IdInvoice)
            ->get();
            // dd($detailSales);

            // $bom = Bom::find($IdSales);
            // dd($bom);

            $invoice = Invoice::find($IdInvoice);
            // dd($sales);
            

        return view('finance.printinvoice', [
            'detailInvoice' => $detailInvoice,
            'detailinvoice' => $detailinvoice,
            'invoice' => $invoice,
            // 'bom' => $bom,
            // 'buyer' => $buyer
        ]);

    }
}
