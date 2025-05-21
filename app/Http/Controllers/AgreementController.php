<?php

namespace App\Http\Controllers;


use App\Models\Agreement;
use App\Http\Requests\API\Agreement\AgreementStoreRequest;
use App\Http\Requests\API\Agreement\AgreementUpdateRequest;
use App\Models\LeadPaintDisclosure;
use App\Models\MaintenanceAddendum;
use App\Models\MonthToMonthAddendum;
use App\Models\NonRenewalNoticeAddendum;
use App\Models\PetAddendum;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AgreementController extends Controller
{
    // show all Agreements (user:admin)
    public function index()
    {
        return Agreement::with('tenant', 'property')->get();
    }

    // show single agreement (Role: user:admin, user:tenate)
    public function show(int $agreement_id)
    {
        return Agreement::with('tenant', 'property.state', 'property.owner.propertyOwner.state')->findOrFail($agreement_id);
    }

    //store aggrement (Role: user:admin)
    //send notification to user via email that their document is ready to be viewed. 
    public function store(AgreementStoreRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = collect($request->validated());
                $agreement = Agreement::create($request->agreement);
                $agreement_id = $agreement->id;
                $addendums_ids = Agreement::addendumsCreate($data, $agreement_id);
                $agreement->update($addendums_ids);
            });
            return response()->json(['message' => 'Agreement and addendums created successfully.'], 201);
        } 
        catch (\Throwable $e) {
            Log::error('Agreement creation failed', ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Failed to create agreement.',
            ], 500);
        }
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
