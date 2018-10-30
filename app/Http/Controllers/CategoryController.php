<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category;
class CategoryController extends Controller
{
    public function category()
    {
        $category = DB::table('categories')->get();
        return view('category.category',[
            'category'=>$category,
        ]);
    }
    public function category_add()
    {
        $category = Category::select('*')
                    ->get();
        
        foreach($category as $k=>$v)
        {
            if(count(explode('-', $v->path))==4)
            {
                unset($category[$k]);
            }
        }
        return view('category.product-category-add',[
            'category'=>$category,
        ]);
    }
    public function insert(Request $req)
    {
        if($req->cat_id!=0)
        {
            $parent_id = Category::select('path')
                                ->where('id',$req->cat_id)
                                ->first();
            $path = $parent_id->path.$req->cat_id.'-';
        }
        else
        {
            $path = '-';
        } 

        $category = new Category;
        $category->parent_id = $req->cat_id;
        $category->cat_name = $req->cat_name;
        $category->path = $path;
        $category->save();
        return redirect()->route('category');
    }
    public function delete(Request $req)
    {
        $id = $req->id;
        DB::delete('delete from categories where id=?',[$id]);   
        Category::where('path','like','%-'.$id.'-%')
                    ->delete();

                   
    }
    public function category_edit(Request $req,$id)
    {
        $categories = Category::select('*')
                    ->get();
        
        foreach($categories as $k=>$v)
        {
            if(count(explode('-', $v->path))==4)
            {
                unset($categories[$k]);
            }
        }
        $category = Category::select('*')
                                ->where('id',$id)
                                ->first();
        
        // dd($category->cat_name);
        return view('category.category_edit',[
            'categories'=>$categories,
            'category'=>$category
        ]);
    }
    public function edit(Request $req,$id)
    {
        $id = $req->id;

        if($req->cat_id!=0)
        {
            $parent_id = Category::select('path')
                                ->where('id',$req->cat_id)
                                ->first();
            $path = $parent_id->path.$req->cat_id.'-';
        }
        else
        {
            $path = '-';
        } 

        $category = new Category;

        $category = DB::update('update categories set cat_name = ? where id =?',[$req->cat_name,$id]);
        return redirect()->route('category');
    }
}
