<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Kas;

class KasController extends Controller
{
    private $menuname = 'Kas';
    //
    function Index()
    {


        $t_kas = DB::table('t_kas')
            ->leftJoin('m_user', 'm_user.IdUser', '=', 't_kas.IdUser')
            ->where('t_kas.StatusDeleted', '=', 0)
            ->get();

        $dataSaldo = DB::table('t_kas')
        ->select(DB::raw('sum(t_kas.Debit) as Debit, sum(t_kas.Kredit) as Kredit'))->first();
        
        $last_saldo = DB::table('t_kas')
        ->join('m_user', 'm_user.IdUser', '=', 't_kas.IdUser')
        ->select('t_kas.SaldoKas')
        ->latest('TglKas')
        ->first();
        // dd($last_saldo);


        // $databarang = DB::table('m_barang')->get();

        // $datarekanan = DB::table('m_rekanan')->get();

        return view(
            'kas/index',
            [
                'menuname' => $this->menuname,
                'dataSaldo' => $dataSaldo,
                'last_saldo' => $last_saldo,
                't_kas' => $t_kas,
            ]
        );
    }

    function store(Request $request)
    {
        $user = DB::table('m_user')
        ->first();

        $last_saldo = DB::table('t_kas')
        ->select(DB::raw('sum(t_kas.Debit) as Debit, sum(t_kas.Kredit) as Kredit'))
        // ->latest('TglKas')
        ->first();
        
        $saldo_terakhir = $last_saldo->Debit - $last_saldo->Kredit;
        // dd($saldo_terakhir);

        $add = new Kas;
        // $add->IdKas = $request->input('IdKas');
        $add->IdUser = $request->session()->get('IdUser', $user->IdUser);
        if ($request->type) {
            $add->Kredit = null;
            $add->Debit = $request->input('jumlah');
            $add->SaldoKas = ($saldo_terakhir + $request->input('jumlah'));
        } else {
            $add->Debit = null;
            $add->Kredit = $request->input('jumlah');
            $add->SaldoKas = ($saldo_terakhir - $request->input('jumlah'));
        }

        $add->Keterangan = $request->input('Keterangan');
        $add->TglKas = Carbon::now();
        $add->CreatedAt = Carbon::now();
        $add->StatusDeleted = 0;
        $add->save();
        // dd($add);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Tambah Data'));
    }

    public function destroy($IdKas)
    {
        // menghapus data warga berdasarkan id yang dipilih
        DB::table('t_kas')->where('IdKas', $IdKas)->update([
            'deleted_at' => Carbon::now(),
            'StatusDeleted' => 1
        ]);

        return response()->json(array('status' => 'success', 'reason' => 'Sukses Hapus Data'));
    }
}
