<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Role\RoleStoreRequest;
use App\Http\Requests\API\Role\RoleUpdateRequest;
use App\Models\Role;

class RoleController extends Controller
{
    
    public function index(){
        return Role::all()->toJson();
    }

    public function show(int $role_id){
        return Role::findOrFail($role_id)->toJson();
    }

    public function store(RoleStoreRequest $request){
        return Role::create($request->input())->toJson();
    }

    public function update(RoleUpdateRequest $request, int $role_id){
        $role = Role::find($role_id);
        
        if($role){
            if($role->update($request->input())){
                return $role->toJson();
            }
            else{
                return response()->json(['message' => "Role could not be updated"]);
            }
        }

        return response()->json(['message' => 'Role could not be found.'], 404);
    }

    public function destroy(int $role_id){
        $role = Role::find($role_id);
        if($role){
            $role->delete();
            return response()->json(['message' => 'Role deleted successfully'], 200);
        }
        return response()->json(['message' => 'Role not found'], 404);
    }
}
