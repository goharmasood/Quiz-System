<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreInventoryTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\InventoryType;
class InventoryTypeController extends Controller
{
    //
      function getInventoryTypes(){
            $inventoryTypes = InventoryType::where('is_active', 1)->paginate(5);
            $admin = Session::get('admin');
            //return $admin;
            if($admin){
                return view('inventorytype', [
                    "name"=>$admin->name, 
                    "inventorytypes" => $inventoryTypes
                ]);
            }else{
                return redirect('login');
            }
        
        }

        public function showInventoryTypes(Request $request, $editId = null){
            $admin = Session::get('admin');
            $inventorytypes = InventoryType::where('is_active', 1)->paginate(5);

            $editItem = null;
            if ($editId) {
                $editItem = InventoryType::findOrFail($editId);
            }

            return view('inventorytype', [
                'name' => $admin->name,
                'inventorytypes' => $inventorytypes,
                'editItem' => $editItem
            ]);
        }


        function addInventoryType(StoreInventoryTypeRequest $request){
          

            $admin = session::get('admin');
            //   $inventoryTypes = InventoryType::create([
            // 'name' => $request->inventorytype,
            // 'is_active' => true,
            // 'added_by' => $admin->name ?? 'system',
            //     ]);
            //    Session::flash('inventorytype', "Inventory Type ". "$inventoryTypes->name". " Added");
            //     return redirect('inventorytype');
            $inventoryTypes = new InventoryType();
            $inventoryTypes->name = $request->inventorytype;
            $inventoryTypes->is_active = true;
            $inventoryTypes->added_by = $admin->name ?? 'system';
            
            if($inventoryTypes->save()){ 
                Session::flash('inventorytype', "Inventory Type ". "$inventoryTypes->name". " Added");
            }
            return redirect('inventorytype');

        }

        public function updateInventoryType(StoreInventoryTypeRequest $request, $id)
        {
            $inventoryTypes = InventoryType::find($id);
            $inventoryTypes->name = $request->inventorytype;
            $inventoryTypes->save();

            if($inventoryTypes->save()){ 
                Session::flash('inventorytype', "Inventory Type ". "$inventoryTypes->name". " Updated");
            }
            return redirect('inventorytype');
        }


       public function deleteInventoryType($id)
        {
            $inventoryTypes = InventoryType::find($id);
            
            if ($inventoryTypes) {
                $inventoryTypes->is_active = 2;
                $inventoryTypes->save();

                Session::flash('inventorytype', "Success: Inventory Type ". "$inventoryTypes->name". " Deleted");
            } else {
                Session::flash('inventorytype', "Error: Inventory Type not found");
            }

            return redirect('inventorytype');

        }

                
}
