<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Goods;
use Image;
use Storage;
use App\Models\Category;
use App\Models\Brand;
class GoodsController extends Controller
{
    public function goods()
    {
        $goods = DB::table('goods')->get();
        return view('goods.Products_List',[
            'goods'=>$goods,
        ]);
    }
    public function goods_add()
    {
        $category = Category::select('*')
                ->where('path','-')
                ->get();
                
        $brand = DB::table('brands')->get();

       return view('goods.picture-add',[
           'category'=>$category,
           'brand'=>$brand,
       ]);
    }
    public function ajax_getParent(Request $req)
    {
        $id = $req->id;
        $data = Category::select('*')
                ->where('parent_id',$id)
                ->get();
        // dd($data->cat_name);
        echo json_encode($data);
    }
    public function insert(Request $req)
    {
        $oldimage = $req->logo->path();  
        $date = date('Ymd');
        $path = public_path().'/uploads/goods_logo/'.$date;
        if(!is_dir($path))
        {
            mkdir($path,true);
        }
        $oriImg = $req->logo->store('goods_logo/'.$date);
        $img = Image::make($oldimage);
        $img->resize(130,130);        
        $img->save(public_path('uploads/'.$oriImg));

        $goods = new Goods;
        $goods->goods_name = $req->goods_name;
        $goods->logo = $oriImg;
        $goods->description = $req->description;
        $goods->cat1_id = $req->cat1_id;
        $goods->cat2_id = $req->cat2_id;
        $goods->cat3_id = $req->cat3_id;
        $goods->brand_id = $req->brand_id;
        $goods->save();
        return redirect()->route('products_list');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        $path = Goods::select('logo')
        ->where('id',$id)
        ->first();
        unlink( public_path().'/uploads/'.$path->logo);
        DB::delete('delete from goods where id=?',[$id]);
    }
    public function no(Request $req)
    {
        $id = $req->id;
        $is_on_sale = DB::update('update goods set is_on_sale="no" where id=?',[$id]);
    }
    public function yes(Request $req)
    {
        $id = $req->id;
        $is_on_sale = DB::update('update goods set is_on_sale="yes" where id=?',[$id]);
    }
    public function goods_edit(Request $req,$id)
    {
        $goods = Goods::select('*')
                        ->where('id',$id)
                        ->first();
        $category = Category::select('*')
                ->where('path','-')
                ->get();
                
        $brand = DB::table('brands')->get();
        return view('goods.goods_edit',[
            'goods'=>$goods,
            'category'=>$category,
            'brand'=>$brand,
        ]);
    }
    public function edit(Request $req,$id)
    {
        $path = Goods::select('logo')
        ->where('id',$id)
        ->first();
        unlink( public_path().'/uploads/'.$path->logo);

        $oldimage = $req->logo->path();  
        $date = date('Ymd');
        $path = public_path().'/uploads/goods_logo/'.$date;
        if(!is_dir($path))
        {
            mkdir($path,true);
        }
        $oriImg = $req->logo->store('goods_logo/'.$date);
        $img = Image::make($oldimage);
        $img->resize(130,130);        
        $img->save(public_path('uploads/'.$oriImg));

        $goods_name =  $req->goods_name;
        $description = $req->description;
        $cat1_id = $req->cat1_id;
        $cat2_id = $req->cat2_id;
        $cat3_id = $req->cat3_id;
        $brand_id = $req->brand_id;

        $goods_edit = new Goods;
        $goods_edit = DB::update('update goods set goods_name = ? , description = ? , cat1_id = ? , cat2_id = ? ,cat3_id = ? ,brand_id = ? , logo = ? where id = ?',
                                [$goods_name,$description,$cat1_id,$cat2_id,$cat3_id,$brand_id,$oriImg,$id]
                        );

        return redirect()->route('products_list');
    }

}
