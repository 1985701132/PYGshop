<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HtLoginController extends Controller
{
    public function login(Request $req)
    {
        return view('htlogin.login');
    }
}
