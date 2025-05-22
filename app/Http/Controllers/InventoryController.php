<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryType;
use Illuminate\Support\Facades\Session;
use App\Models\Inventory;
use App\Http\Requests\StoreInventoryRequest;



class InventoryController extends Controller
{
    //
      function getInventoryType(){
      
        $inventoryTypes = InventoryType::where('is_active', 1)->get();
        $admin = Session::get('admin');
        if($admin){
        return view('inventories', ["name"=>$admin->name, "inventorytypes" => $inventoryTypes]);
        }
        }

    function getInventories(){
      
       $admin = Session::get('admin');
    
    if (!$admin) {
        return redirect('login');
    }

    $inventoryTypes = InventoryType::where('is_active', 1)->get();
    $inventories = Inventory::where('is_active', 1)->get();

    return view('inventories', [
        'name' => $admin->name,
        'inventorytypes' => $inventoryTypes,
        'inventories' => $inventories
    ]);

        return view('inventories');
        }


public function addInventory(StoreInventoryRequest $request)
{
    $inventory = Inventory::create([
        'name'           => $request->inventory,
        'type_id'        => $request->inventorytype,
        'length'      => $request->length,
        'width'       => $request->width,
        'actual_price'   => $request->actual_price,
        'sell_price'     => $request->sell_price,
        'discount_price' => $request->discount_price,
        'total_stock'    => $request->total_stock,
        'is_active'      => 1,
    ]);

    Session::flash('inventory', "Inventory '{$inventory->name}' added successfully.");
    return redirect('addinventory');
}

}
