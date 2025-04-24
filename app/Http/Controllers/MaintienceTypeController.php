<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Maintenance\MaintenaceTypeUpdateRequest;
use App\Http\Requests\API\Maintenance\MaintenaceTypeStoreRequest;
use App\Models\MaintenanceType;

class MaintienceTypeController extends Controller
{
    // show all types  (user:admin)
    public function index(){
        return MaintenanceType::all();
    }

    // show single types (Role: user:admin, user:tenate, user:maintenence)
    public function show(int $type_id){
        return MaintenanceType::findOrFail($type_id);
    }

    // show single types (Role: user:admin, user:tenate, user:maintenence)
    public function store(MaintenaceTypeStoreRequest $request){
        return MaintenanceType::create($request->input());
    }

    // update single types (Role: user:admin, user:maintenence)
    public function update(MaintenaceTypeUpdateRequest $request, int $type_id){
        $mainType = MaintenanceType::find($type_id);

        if($mainType){
            if($mainType->update($request->input())){
                return $mainType->toJson();
            }
            else{
                return response()->json(['message' => "Maintenance type could not be updated"]);
            }
        }
        
        return response()->json(['message' => 'Maintenance type not found']);
    }

    public function destroy(int $type_id){
        $mainType = MaintenanceType::find($type_id);

        if($mainType){
            $mainType->delete();
            return response()->json(['message' => 'Maintenance type has been deleted.']);
        }
    
        return response()->json(['message' => 'Maintenance type could not be found'], 404);
    }
}
