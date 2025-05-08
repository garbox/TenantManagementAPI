<?php

namespace App\Http\Controllers;

use App\Models\PropertyOwner;
use App\Http\Requests\API\PropertyOwner\PropertyOwnerUpdateRequest;
use App\Http\Requests\API\PropertyOwner\PropertyOwnerStoreRequest;
use App\Models\User;
use Illuminate\Support\Carbon;

class PropertyOwnerController extends Controller
{
    // show all property owner (user:admin)
    public function index()
    {
        return PropertyOwner::all()->toJson();
    }

    // show single property owner (Role: user:admin, user:owner)
    public function show(int $owner_id)
    {
        return User::with('properties', 'properties.state', 'properties.activeAgreement.status', 'properties.activeAgreement.tenant')
            ->FindOrFail($owner_id);
    }

    public function store(PropertyOwnerStoreRequest $request)
    {
        return PropertyOwner::create($request->input())->toJson();
    }

    // update single property owner (Role: user:admin, user:owner)
    public function update(PropertyOwnerUpdateRequest $request, int $owner_id)
    {
        $owner = PropertyOwner::find($owner_id);

        if ($owner) {
            if ($owner->update($request->input())) {
                return $owner->toJson();
            } else {
                return response()->json(['message' => "Property owner could not be updated"]);
            }
        }

        return response()->json(['message' => 'Property owner could not be found.'], 404);
    }

    // delete single types (Role: user:admin)
    public function destroy(int $owner_id)
    {
        $owner = PropertyOwner::find($owner_id);

        if ($owner) {
            $owner->delete();
            return response()->json(['message' => 'Property owner deleted'], 200);
        }

        return response()->json(['message' => 'Property owner not found'], 404);
    }
}
