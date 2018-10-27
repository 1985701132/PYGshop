<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function user(Request $req)
    {   
        if($req->keyword)
        {
            $users = User::select('*')
                    ->where('username','like',"%{$req->keyword}%")
                    ->orWhere('mobile','like',"%{$req->keyword}%")
                    ->orWhere('email','like',"%{$req->keyword}%")
                    ->paginate(5);
                    // ->toSql();

        }
        else if($req->time)
        {
            $users = User::select('*')
                    ->where('created_at','like',"%{$req->time}%")
                    ->paginate(5);
        }
        else
        {
            $users = User::paginate(5);
        }
        // dd($users);
        // $users = User::paginate(2);
        // dd($users);
        return view('user.user_list',[
            'users'=>$users,
            'req'=>$req
        ]);
    }
    public function insert(Request $req)
    {
        $password = Hash::make('123');
        $users = new User;

        $users->gender = $req->acc;
        $users->username = $req->username;
        $users->password = $password;
        $users->mobile = $req->mobile;
        $users->email = $req->email;
        $users->address = $req->address;
        $users->save();
        return redirect()->route('user_list');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        DB::delete('delete from users where id=?',[$id]);
        return redirect()->route('user_list');
    }
    public function no(Request $req)
    {
        $id = $req->id;
        $is_use = DB::update('update users set is_use="no" where id=?',[$id]);
    }
    public function yes(Request $req)
    {
        $id = $req->id;
        $is_use = DB::update('update users set is_use="yes" where id=?',[$id]);
    }


}
