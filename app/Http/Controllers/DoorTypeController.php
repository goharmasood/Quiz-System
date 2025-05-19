<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\DoorType;
class DoorTypeController extends Controller
{
    //
      function getDoorTypes(){
        $doorTypes = DoorType::get();
        $admin = Session::get('admin');
        //return $admin;
        if($admin){
        return view('doortypes', ["name"=>$admin->name, "doortypes" => $doorTypes]);
        }else{
        return redirect('login');
        }
        
        }


        function addDoorType(Request $request){
           $request->validate([
            "doortype" => "required|min:3|unique:door_types,name"
            ]);

         $admin = session::get('admin');
         $doorType = new DoorType();
         $doorType->name = $request->doortype;
         $doorType->is_active = 1;
         $doorType->added_by = $admin->name;
         if($doorType->save()){ 
          Session::flash('doortype', "Door Type ". "$doorType->name". " Added");
         }
         return redirect('doortypes');
        }

        
}
