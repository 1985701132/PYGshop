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
        echo json_encode($data);
    }
    public function insert(Request $req)
    {
        if($req->logo){
            $oldimage = $req->logo->path();  
            $date = date('Ymd');
            $oriImg = $req->logo->store('goods_logo/'.$date);
            $img = Image::make($oldimage);
            $img->resize(130,130);        
            $img->save(public_path('uploads/'.$oriImg));
        }
        
        $goods = new Goods;
        $goods->goods_name = $req->goods_name;
        $goods->logo = $oriImg;
        $goods->description = $req->description;
        $goods->cat1_id = $req->cat1_id;
        $goods->cat2_id = $req->cat2_id;
        $goods->cat3_id = $req->cat3_id;
        $goods->brand_id = $req->brand_id;
        $goods->save();

        //添加商品属性
        $id = DB::getPdo()->lastInsertId();
        if($req->attr_name && $req->attr_value){
            foreach($req->attr_name as $k=>$v){
                $req->attr_value[$k];
                DB::insert('insert into goods_attribute (attr_name,attr_value,goods_id) values (?,?,?)',[$v,$req->attr_value[$k],$id]);
            }
        }

         //添加商品SKU
         if($req->sku_name && $req->stock && $req->price){
             foreach($req->sku_name as $k=>$v){
                 $req->stock[$k];
                 $req->price[$k];
                 DB::insert('insert into goods_sku (sku_name,stock,price,goods_id) values (?,?,?,?)',[$v, $req->stock[$k],$req->price[$k],$id]);
             }
         }

         //添加商品图片
        if($req->image){
            $image = $req->file('image');
            foreach($image as $k=>$v){
                $date = date('Ymd');
                $oriImg = $v->store('goods_image/'.$date);
                $oldimage = $v->path();  
                $img = Image::make($oldimage);
                $img->resize(350,250);        
                $img->save(public_path('uploads/'.$oriImg));
                DB::insert('insert into goods_image (path,goods_id) values (?,?)',[$oriImg,$id]);
            }
        }
        return redirect()->route('products_list');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        $path = Goods::select('logo')
        ->where('id',$id)
        ->first();
        unlink( public_path().'/uploads/'.$path->logo);

        $imgPath = DB::select('select path from goods_image where goods_id=?',[$id]);
        foreach($imgPath as $v){
            unlink( public_path().'/uploads/'.$v->path);
        }
        DB::delete('delete from goods_attribute where goods_id=?',[$id]);
        DB::delete('delete from goods_sku where goods_id=?',[$id]);
        DB::delete('delete from goods_image where goods_id=?',[$id]);
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
        $attr = DB::select('select attr_name , attr_value from goods_attribute where goods_id = ?',[$id]);
        $sku = DB::select('select * from goods_sku where goods_id = ?',[$id]);
        $image = DB::select('select * from goods_image where goods_id = ?',[$id]);
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
            'attr'=>$attr,
            'sku'=>$sku,
            'image'=>$image,
        ]);
    }
    public function edit(Request $req,$id)
    {
        if($req->logo){
            $path = Goods::select('logo')
                        ->where('id',$id)
                        ->first();
            unlink( public_path().'/uploads/'.$path->logo);

            $oldimage = $req->logo->path();  
            $date = date('Ymd');
            $oriImg = $req->logo->store('goods_logo/'.$date);
            $img = Image::make($oldimage);
            $img->resize(130,130);        
            $img->save(public_path('uploads/'.$oriImg));
        }
        else
        {
            $path = Goods::select('logo')
                        ->where('id',$id)
                        ->first();
            $oriImg = $path->logo;
        }
        

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

        DB::delete('delete from goods_attribute where goods_id=?',[$id]);
        DB::delete('delete from goods_sku where goods_id=?',[$id]);

        if($req->attr_name && $req->attr_value){
            foreach($req->attr_name as $k=>$v){
                $req->attr_value[$k];
                DB::insert('insert into goods_attribute (attr_name,attr_value,goods_id) values (?,?,?)',[$v,$req->attr_value[$k],$id]);
            }
        }

         if($req->sku_name && $req->stock && $req->price){
             foreach($req->sku_name as $k=>$v){
                 $req->stock[$k];
                 $req->price[$k];
                 DB::insert('insert into goods_sku (sku_name,stock,price,goods_id) values (?,?,?,?)',[$v, $req->stock[$k],$req->price[$k],$id]);
             }
         }

         if($req->img_id){
            $img_id = explode(',', $req->img_id);
            foreach($img_id as $v){
                $img_path = DB::select('select * from goods_image where id = ?',[$v]);
                foreach($img_path as $v){
                    unlink( public_path().'/uploads/'.$v->path);
                }
                DB::delete('delete from goods_image where id = ?',[$v->id]);
            }

            $image = $req->file('image');
            foreach($image as $k=>$v){
                $date = date('Ymd');
                $oriImg = $v->store('goods_image/'.$date);
                $oldimage = $v->path();  
                $img = Image::make($oldimage);
                $img->resize(350,250);        
                $img->save(public_path('uploads/'.$oriImg));
                DB::insert('insert into goods_image (path,goods_id) values (?,?)',[$oriImg,$id]);
            }
        }
        return redirect()->route('products_list');
    }

}
