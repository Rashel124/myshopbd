<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class adminauthcontroller extends Controller
{
    public function adminlogin(){
        return view('backend.admin-login');
    }
    public function adminlogout()
    {
        Auth::logout();
    
        return redirect('/admin/login');
    }
}
