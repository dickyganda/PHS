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
        ->get();
        // dd($bomdetail);

        return view('procurement.index', compact('procurementdetail'));
    }
}
