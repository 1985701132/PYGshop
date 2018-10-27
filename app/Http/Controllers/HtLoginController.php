<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash;

class HtLoginController extends Controller
{
    public function login(Request $req)
    {
        return view('htlogin.login');
    }
    public function dologin(Request $req)
    {
        $admin = Admin::where('username',$req->username)->first();
        // $password = Hash::make($req->password);
        // $req->password = $password;

        if($admin)
        {
            // dd(Hash::check($req->password,$admin->password));

            if(Hash::check($req->password,$admin->password))
            {
                session([
                    'id' =>$admin->id,
                    'username' => $admin->username,
                ]);
                return redirect()->route('htindex');                
            }
            return back()->withInput()->withErrors('密码不正确');
        }
        else
        {
            return back()->withInput()->withErrors('用户不存在');
        }
    }
}

