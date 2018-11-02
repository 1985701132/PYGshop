<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash;


class AdminController extends Controller
{
    public function admin(Request $req)
    {   
        // dd($req->username);
        // $admins = DB::table('admins')->get();
        // dd($admins);
        if($req->username)
        {
            $admins = Admin::select('*')
                    ->where('username','like',"%{$req->username}%")
                    ->paginate(5);
                    //  ->toSql();
        }
        else if($req->time)
        {
            $admins = Admin::select('*')
                    ->where('created_at','like',"%{$req->time}%")
                    ->paginate(5);
        }
        else
        {
            $admins = Admin::paginate(5);
        }

        return view('admin.administrator',[
            'admins'=>$admins,
            'req'=>$req,
            ]);
    }
    public function delete(Request $req)
    {
        // dd($req);
        $id = $req->id;
        DB::delete('delete from admins where id=?',[$id]);

        return redirect()->route('administrator');
    }
    public function insert(Request $req)
    {
        $password = Hash::make($req->userpassword);
        $admin = new Admin;
        
        $admin->username = $req->username;
        $admin->password = $password;
        $admin->mobile = $req->usertel;
        $admin->email = $req->email;

        // dd($req->username,$req->userpassword,$req->usertel,$req->email);

        $admin->save();
        return redirect()->route('administrator');
    }
    public function edit()
    {
        $admins = DB::table('admins')->first();
        // dd($admins);
        $admin = new Admin;

    }
    public function doedit()
    {

    }
    
}
