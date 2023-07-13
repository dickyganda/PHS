<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class DashboardController extends Controller
{
    //
    private $menuname = 'Dashboard';

    public function index()
    {
    //    $cek = Menu::with('SubMenus')->whereNull('MainMenu')->get();
// dd($cek);
        return view('dashboard.index', [
            'menuname' => $this->menuname,
        ]);
    }
}
