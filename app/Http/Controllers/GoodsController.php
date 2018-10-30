<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function goods()
    {
       return view('goods.Products_List');
    }
    public function insert()
    {
       return view('goods.picture-add');
    }
}
