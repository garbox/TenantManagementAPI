<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\MaintienceTypeController;
use App\Http\Controllers\MaintenanceExpenseController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\PropertyOwnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MaintenanceStatusController;

Route::middleware('auth:sanctum')->group(function () {
});
    Route::resource('user', UserController::class)->except(['create', 'edit', 'store']);
    Route::put('user/{user}/role', [UserController::class, 'updateRole'])->name('user.role.update');
    Route::post('user/register', [UserController::class, 'store'])->name('user.register');

    Route::resource('role', RoleController::class)->except(['create', 'edit']);
    Route::resource('property', PropertyController::class)->except(['create', 'edit']);
    Route::resource('agreement', AgreementController::class)->except(['create', 'edit']);
    Route::get('agreement/report/status', [AgreementController::class, 'getStatus'])->name('agreement.status');
    Route::resource('report', ReportController::class)->except(['create', 'edit']);
    
    Route::resource('maintenance/request', MaintenanceController::class)->except(['create', 'edit']);
    Route::resource('maintenance/type', MaintienceTypeController::class)->except(['create', 'edit']);
    Route::resource('maintenance/exspense', MaintenanceExpenseController::class)->except(['create', 'edit']);  
    Route::get('maintenance/request/user/{user}', [UserController::class, 'getMaintenanceRequests'])->name('maintenance.user.requests');
    Route::get('maintenance/search', [MaintenanceController::class, 'search'])->name('maintenance.search');
    Route::get('maintenance/report/status', [MaintenanceController::class, 'getStatus'])->name('maintenance.report.status');
    Route::resource('maintenance/status', MaintenanceStatusController::class)->except(['create', 'edit','update', 'destroy', 'store']);

    Route::resource('payment', PaymentController::class)->except(['create', 'edit']);
    Route::resource('owner', PropertyOwnerController::class)->except(['create', 'edit']);

    Route::resource('state', RoleController::class)->except(['create', 'edit', 'update', 'store', 'destroy']);

    Route::post('login', [UserController::class, 'login'])->name('user.login');






    


