<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceStatus;
use Illuminate\Http\Request;

class MaintenanceStatusController extends Controller
{
    public function index(){
        return MaintenanceStatus::all();
    }

    public function show($status){
        return MaintenanceStatus::findOrFail($status);
    }
}
