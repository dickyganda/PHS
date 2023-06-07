<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;

use App\Models\Menu;
use App\Models\Submenu;

class MenuController extends Controller
{
    //
    public function index()
    {
    $menu = DB::table('m_menu')
        ->where('Status', '=', 1)
        ->get();
        // dd($menu);

        // return view('layouts.sidebar', compact('menu'));
        return view('layouts.sidebar', [
            'menu' => $menu,
        ]);

    }
}
