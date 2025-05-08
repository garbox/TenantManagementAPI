<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Http\Requests\API\Property\PropertyStoreRequest;
use App\Http\Requests\API\Property\PropertyUpdateRequest;

class PropertyController extends Controller
{
    // show all properties (user:admin)
    public function index(){
        return Property::with(['owner', 'state'])->get()->toJson();
    }

    // show single property (Role: user:admin, user:tenate, user:maintenence)
    public function show(int $property_id){
        return Property::with(['owner', 'owner.propertyOwner.state', 'state', 'agreements.tenant', 'maintenances.type', 'maintenances.status'])
        ->findOrFail($property_id);
    }

    // show single property (Role: user:admin, user:tenate, user:maintenence)
    public function store(PropertyStoreRequest $request){
        return Property::create($request->input())->toJson();
    }
    
    // update single types (Role: user:admin, user:owner)
    public function update(PropertyUpdateRequest $request, int $property_id){
        $property = Property::find($property_id);

        if($property){
            if($property->update($request->input())){
                return $property->toJson();
            }
            else{
                return response()->json(['message' => "Property could not be updated"]);
            }
        }

        return response()->json(['message' => 'Property could not found']);
    }

    // delete single types (Role: user:admin)
    public function destroy(int $property_id){
        $property = Property::find($property_id);

        if($property){
            $property->delete();
            return response()->json(['message' => 'Property deleted'], 200);
        }

        return response()->json(['message' => 'Property not found'], 404);
    }
}
