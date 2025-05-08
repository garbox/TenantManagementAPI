<?php

namespace App\Http\Controllers;


use App\Models\Agreement;
use App\Http\Requests\API\Agreement\AgreementStoreRequest;
use App\Http\Requests\API\Agreement\AgreementUpdateRequest;

class AgreementController extends Controller
{
    // show all Agreements (user:admin)
    public function index()
    {
        return Agreement::with('user', 'property')->get();
    }

    // show single agreement (Role: user:admin, user:tenate)
    public function show(int $agreement_id)
    {
        return Agreement::with('user', 'property.state', 'property.owner.propertyOwner.state')->findOrFail($agreement_id);
    }

    //store aggrement (Role: user:admin)
    //send notification to user via email that their document is ready to be viewed. 
    public function store(AgreementStoreRequest $request)
    {
        return Agreement::create($request->input());
    }

    //update aggrement (Role: user:admin)
    //send notification to user and agreement has been updated.
    public function update(AgreementUpdateRequest $request, int $agreement_id)
    {
        $agreement = Agreement::find($agreement_id);

        if ($agreement) {
            if ($agreement->update($request->input())) {
                return $agreement;
            } else {
                return response()->json(['message' => "Role could not be updated"]);
            }
        }

        return response()->json(['message' => 'Role could not be found.'], 404);
    }

    //delete aggrement (Role: user:admin)
    public function destroy(int $agreement_id)
    {
        $agreement = Agreement::find($agreement_id);

        if ($agreement) {
            $agreement->delete();
            return response()->json(['message' => 'Agreement has been deleted.']);
        } else {
            return response()->json(['message' => ' Agreement could not be deleted or found.']);
        }
    }

    public function getStatus()
    {
        return Agreement::statusCount();
    }
}
