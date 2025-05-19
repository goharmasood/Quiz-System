<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;

class AuthController extends Controller
{
    //
   
    function login(Request $request){
        $validation = $request->validate([
                "name"=>"required",
                "password"=>"required",
        ]);
        
         $admin = Admin::where([
            ['name', '=', $request->name],
            ['password', '=', $request->password],
         ])->first();

    if (!$admin) {
    return back()->withErrors(['login' => 'Invalid credentials'])->withInput();
}

     Session::put('admin',$admin);
    return redirect('dashboard');

    //return view('admin', ["name"=> $request->name]);
}

function logout(){
    Session::forget('admin');
    return redirect('login');
}

       
}
