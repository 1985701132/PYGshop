<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{   
    public function index()
    {
        // $users = DB::select('SELECT * FROM user');
        // dd($users);
        return view('index.index');
    }
    public function htindex()
    {
        return view('htindex.index');
    }
    public function home()
    {
        return view('htindex.home');
    }
}
