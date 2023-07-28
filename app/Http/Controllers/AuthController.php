<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input; //untuk input::get
use Illuminate\Support\Facades\Auth;
use Redirect;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\Models\User;
// use App\Models\M_User_Level;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login')->with('sukses', 'Anda Berhasil Login');
    }

    function authenticate(Request $request)
    {
        $name = $request->input('Name');
        $password = $request->input('Password');

        $query = DB::table('m_user')
            ->where('Name', $name)
            ->where('Password', md5($password))
            ->where('Status', '=', '1')
            ->first();
        if (empty($query)) {
            return response()->json(array('status' => 'failed', 'reason' => 'data tidak ada'));
        }
        // Session::put('level_user', $query->level_user);
        
        $datamenu = DB::table('m_action')
        ->join('m_jabatan','m_jabatan.IdJabatan', '=', 'm_action.IdJabatan')
        ->join('m_menu','m_menu.IdMenu', '=', 'm_action.IdMenu')
        ->join('m_user','m_user.IdJabatan', '=', 'm_jabatan.IdJabatan')
        ->where('IdUser', $query->IdUser)
        ->orderBy('m_menu.IdMenu')
        ->orderBy('m_menu.MainMenu')
        ->orderBy('m_menu.MenuKategori')
        ->get();
        // dd($datamenu);

        $main_menu = [];
        foreach($datamenu as $data){
            $main_menu[] = $data->MainMenu;
        }

        $menu = DB::table('m_menu')
        ->where('MenuKategori', 1)
        ->whereIn('MainMenu', $main_menu)
        ->orderBy('IdMenu')
        ->get();
        
        Session::put('IdUser', $query->IdUser);
        Session::put('datamenu', $datamenu);
        Session::put('menu', $menu);

        // dd($query->nama_user);
        return response()->json(array('status' => 'success', 'reason' => 'sukses'));

    }

    public function logout(){
        // Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        Session::flush();
        Session::save();

        return redirect('/login');
    }
}
