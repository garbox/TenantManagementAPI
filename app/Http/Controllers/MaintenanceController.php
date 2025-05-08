<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Requests\API\Maintenance\MaintenaceStoreRequest;
use App\Http\Requests\API\Maintenance\MaintenaceUpdateRequest;
use App\Http\Requests\API\Maintenance\MaintenanceSearch;

class MaintenanceController extends Controller
{
    // show all Request  (user:admin)
    public function index(){
        return Maintenance::with(['status', 'user', 'property', 'type'])->get();
    }

    // show single Request (Role: user:admin, user:tenate, user:maintenence)
    public function show(int $request_id){
        return Maintenance::with('expenses', 'user', 'user.role', 'type', 'property', 'property.state', 'assignedTo', 'status')->findOrFail($request_id);
    }

    // update single Request (Role: user:admin, user:tenate, user:maintenence)
    public function update(MaintenaceUpdateRequest $request, int $request_id){
        $maintenance = Maintenance::findOrFail($request_id);
         return $maintenance->update($request->input());
    }

    //create new Request (Role: user:admin, user:tenate, user:maintenence)
    public function store(MaintenaceStoreRequest $request){
        return Maintenance::create($request->input())->toJson();
    }

    // delete single Request (Role: user:admin, ?user:maintenence?)
    public function destroy(int $request_id){
        $maintenance = Maintenance::find($request_id);

        if($maintenance){
            $maintenance->delete();
            return response()->json(['message' => 'Maintenance requst has been deleted.']);
        }

        return response()->json(['message' => 'Maintenance request could not be found']);

    }
    
    public function getStatus(){
        return Maintenance::statusCount();
    }

    // search for 
    public function search(MaintenanceSearch $searchParam){
        return Maintenance::with('assignedTo', 'property','user.role', 'type', 'status')->where($searchParam->field, $searchParam->value)->get(); 
    }
}
