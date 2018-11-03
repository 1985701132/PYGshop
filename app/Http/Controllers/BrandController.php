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
        $oriImg = $req->logo->store('brand_logo/'.$date);
        $img = Image::make($oldimage);
        $img->resize(120,60);        
        $img->save(public_path('uploads/'.$oriImg));

        $brand = new Brand;
        $brand->brand_name = $req->brand_name;
        $brand->logo = $oriImg;
        $brand->region = $req->region;
        $brand->save();
        return redirect()->route('brand');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        $path = Brand::select('logo')
        ->where('id',$id)
        ->first();
        unlink( public_path().'/uploads/'.$path->logo);
        DB::delete('delete from brands where id=?',[$id]);
    }
}
