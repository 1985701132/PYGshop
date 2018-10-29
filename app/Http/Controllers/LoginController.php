<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class LoginController extends Controller
{
    public function login(Request $req)
    {
        return view('login.login');
    }
    public function dologin(Request $req)
    {
        // $user = User::where('mobile',$req->mobile)->first();
        $user = User::where('username',$req->username)->first();
        // dd($user->is_use);
        if($user)
        {
            if($user->is_use=='no')
            {
                return back()->withInput()->withErrors('该用户已被停用');
            }
            if(Hash::check($req->password,$user->password))
            {
                session([
                    'id' =>$user->id,
                    'username' => $user->username,
                ]);
                return redirect()->route('index');
            }
            return back()->withInput()->withErrors('密码不正确');
        }
        else
        {
            return back()->withInput()->withErrors('用户不存在');
        }
    }
}
