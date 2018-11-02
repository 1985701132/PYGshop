<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Privilege;
use Hash;
class RoleController extends Controller
{
    public function role()
    {
        $role = DB::table('roles')
                    ->join('admin_role','id','=','role_id')
                    ->join('admins','admins.id','=','admin_id')
                    ->select('roles.id','roles.role_name',DB::raw("GROUP_CONCAT(admins.username) as namelist"),DB::raw("count(admins.username) as namecount"))
                    ->groupBy('roles.id')
                    ->get();
                // dd($role);
        return view('admin.admin_Competence',[
            'role'=>$role,
        ]);
    }
    public function role_add()
    {
        $admins = DB::table('admins')->get();
        $pri = new Privilege;
        $data = $pri->tree();
        // dd($data);
        return view('admin.Competence',[
            'admins'=>$admins,
            'data'=>$data,
        ]);
    }
    public function insert(Request $req)
    {
        $role = new Role;
        $role->role_name = $req->role_name;
        $role->save();

        $req->pri_name;
        $role_id = DB::getPdo()->lastInsertId();

        $pri_id = $req->pri_name;
        if($pri_id){
            foreach($pri_id as $v){
                DB::insert('insert into role_privilege (pri_id,role_id) values (?,?)',[$v,$role_id]);
            }
        }

        $admin_id = $req->username;
        if($admin_id){
        foreach($admin_id as $v){
            DB::insert('insert into admin_role (role_id,admin_id) values (?,?)',[$role_id,$v]);
        }
    }
        

        return redirect()->route('role');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        DB::delete('delete from admin_role where role_id=?',[$id]);
        DB::delete('delete from role_privilege where role_id=?',[$id]);
        DB::delete('delete from roles where id=?',[$id]);
        return redirect()->route('role');
    }


}
