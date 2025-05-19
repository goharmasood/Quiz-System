<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class DashboardController extends Controller
{
    //
     function dashboard(){
        $admin = Session::get('admin');
        //return $admin;
        if($admin){
        return view('dashboard', ["name"=>$admin->name]);
        }else{
        return redirect('login');
        }
        
        }
}
