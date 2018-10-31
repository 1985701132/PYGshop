<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Brand;
use Image;
use Storage;

class BrandController extends Controller
{
    public function brand()
    {   
        $brand = DB::table('brands')->get();
        return view('brand.Brand_Manage',[
            'brand'=>$brand,
        ]);
    }
    public function brand_add()
    {
        return view('brand.Add_Brand');
    }
    public function insert(Request $req)
    {  
        $oldimage = $req->logo->path();  
        $date = date('Ymd');
        $path = public_path().'/uploads/brand_logo/'.$date;
        if(!is_dir($path))
        {
            mkdir($path,true);
        }
        $oriImg = $req->logo->store('brand_logo/'.$date);
        $img = Image::make($oldimage);
        $img->resize(120,60);        
        $img->save(public_path('uploads/'.$oriImg));

        $user = new Brand;
        $user->brand_name = $req->brand_name;
        $user->logo = $oriImg;
        $user->region = $req->region;
        $user->save();
        return redirect()->route('brand');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        DB::delete('delete from brands where id=?',[$id]);
        $path = Brand::select('logo')
        ->where('id',$id)
        ->first();

        unlink( public_path().'/uploads/'.$path->logo);
        return redirect()->route('brand');

    }
}