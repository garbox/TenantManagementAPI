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
use App\Http\Controllers\StateController;

Route::middleware('auth:sanctum')->group(function () {
});
    Route::resource('user', UserController::class)->except(['create', 'edit', 'store']);
    Route::put('user/{user}/role', [UserController::class, 'updateRole'])->name('user.role.update');
    Route::post('user/register', [UserController::class, 'store'])->name('user.register');
    Route::get('user/byrole/{role_id}', [UserController::class, 'getUsersByRoles'])->name('user.byrole');

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

    Route::post('payment/intent', [PaymentController::class, 'createPaymentIntent'])->name('user.payment.intent');
    Route::post('payment/confirm', [PaymentController::class, 'confirmPayment'])->name('user.payment.confirm');
    Route::resource('owner', PropertyOwnerController::class)->except(['create', 'edit']);

    Route::resource('state', StateController::class)->except(['create', 'edit', 'update', 'store', 'destroy','show']);
    Route::get('state/{type}/{id?}', [StateController::class, 'stateReturnFormat'])->name('state.return.format');

    Route::post('login', [UserController::class, 'login'])->name('user.login');






    


