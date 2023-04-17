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
        $name = $request->input('name');
        $password = $request->input('password');

        $query = DB::table('m_user')
            ->where('name', $name)
            ->where('password', md5($password))
            ->where('status_user', '=', '1')
            ->first();
        if (empty($query)) {
            return response()->json(array('status' => 'failed', 'reason' => 'data tidak ada'));
        }
        Session::put('level_user', $query->level_user);

        // dd($query->nama_user);
        return response()->json(array('status' => 'success', 'reason' => 'sukses'));

    }
}
