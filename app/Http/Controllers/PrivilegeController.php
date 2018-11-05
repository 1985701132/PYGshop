<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Privilege;

class PrivilegeController extends Controller
{
    public function privilege()
    {
        $privilege = DB::table('privileges')->get();
        return view('privilege.privilege',[
            'privilege'=>$privilege,
        ]);
    }
    public function privilege_add()
    {
        $privilege = Privilege::select('*')
                    ->get();
        
        foreach($privilege as $k=>$v)
        {
            if(count(explode('-', $v->path))==4)
            {
                unset($privilege[$k]);
            }
        }
        return view('privilege.privilege_add',[
            'privilege'=>$privilege,
        ]);
    }
    public function insert(Request $req)
    {
        if($req->cat_id!=0)
        {
            $parent_id = Privilege::select('path')
                                ->where('id',$req->cat_id)
                                ->first();
            $path = $parent_id->path.$req->cat_id.'-';
        }
        else
        {
            $path = '-';
        } 

        $privilege = new Privilege;
        $privilege->parent_id = $req->cat_id;
        $privilege->pri_name = $req->pri_name;
        $privilege->url_path = $req->url_path;
        $privilege->path = $path;
        $privilege->save();
        return redirect()->route('privilege');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        DB::delete('delete from privileges where id=?',[$id]);   
        Privilege::where('path','like','%-'.$id.'-%')
                    ->delete();

                   
    }
    public function privilege_edit(Request $req,$id)
    {
        $privileges = Privilege::select('*')
                    ->get();
        
        foreach($privileges as $k=>$v)
        {
            if(count(explode('-', $v->path))==4)
            {
                unset($privileges[$k]);
            }
        }
        $privilege = Privilege::select('*')
                                ->where('id',$id)
                                ->first();
        
        return view('privilege.privilege_edit',[
            'privileges'=>$privileges,
            'privilege'=>$privilege
        ]);
    }
    public function edit(Request $req,$id)
    {
        $id = $req->id;

        if($req->cat_id!=0)
        {
            $parent_id = Privilege::select('path')
                                ->where('id',$req->cat_id)
                                ->first();
            $path = $parent_id->path.$req->cat_id.'-';
        }
        else
        {
            $path = '-';
        } 

        DB::update('update privileges set pri_name = ? ,url_path = ? where id =?',[$req->pri_name,$req->url_path,$id]);
        return redirect()->route('privilege');
    }
}
