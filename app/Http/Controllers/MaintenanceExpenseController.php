<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\API\Maintenance\MaintenaceExpenseStoreRequest;
use App\Http\Requests\API\Maintenance\MaintenaceExpenseUpdateRequest;
use App\Models\MaintenanceExpense;

class MaintenanceExpenseController extends Controller
{
    // show all Exspenses  (user:admin)
    public function index(){
        return MaintenanceExpense::all()->toJson();
    }

    // show single Exspenses (Role: user:admin, user:maintenence)
    public function show(int $expense_id){
        return MaintenanceExpense::findOrFail($expense_id)->toJson();
    }

    // show single Exspenses (Role: user:admin, user:maintenence)
    public function store(MaintenaceExpenseStoreRequest $request){
        return MaintenanceExpense::create($request->input());
    }

    // update single Exspenses (Role: user:admin, user:maintenence)
    public function update(MaintenaceExpenseUpdateRequest $request, int $expense_id){
        $mainExpense = MaintenanceExpense::find($expense_id);

        if($mainExpense){
            if($mainExpense->update($request->input())){
                return $mainExpense->toJson();
            }
            else{
                return response()->json(['message' => "Maintenance expense could not be updated"]);
            }
        }

        return response()->json(['message' => 'Maintenance exspense recored not found.']);
    }

    // delete single Expenses (Role: user:admin, user:maintenence)
    public function destroy(int $expense_id){
        $mainExpense = MaintenanceExpense::find($expense_id);

        if($mainExpense){
            $mainExpense->delete();
            return response()->json(['message' => 'Maintenance expense has been deleted.']);
        }
    
        return response()->json(['message' => 'Maintenance expense could not be found'], 404);
    }

}
