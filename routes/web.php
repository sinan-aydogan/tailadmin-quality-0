<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/', function () {
        return Inertia::render('Dashboard',[
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
})->name('/');

    /*They are the required pages for the system, don't delete it*/
    Route::prefix('settings')->group(function () {
       Route::get('/', function () {return Inertia::render('Settings/Index',[
           'users_count' => count(\App\Models\User::all('id')),
           'roles_count' => count(Role::all()),
           'permissions_count' => count(Permission::all())
       ]);})->name('settings');
       Route::resource('settings-user', \App\Http\Controllers\Settings\UserController::class);
       Route::get('role', function () {return Inertia::render('Settings/Role');})->name('settings-role');
       Route::get('permission', function () {return Inertia::render('Settings/Permission');})->name('settings-permission');
       Route::get('system', function () {return Inertia::render('Settings/System');})->name('settings-system');
        /*Property Management*/
        Route::resource('settings-property', \App\Http\Controllers\Settings\PropertyController::class);
        Route::resource('settings-property-type', \App\Http\Controllers\Settings\PropertyTypeController::class);
    });

    /*Tailadmin Quality Routes*/
    //Department
    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::get('department/trash', [\App\Http\Controllers\DepartmentController::class, 'trash'])->name('department.trash');
    //Staff
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
    Route::get('staff/trash', [\App\Http\Controllers\StaffController::class, 'trash'])->name('staff.trash');
    //Job Description
    Route::resource('job-description', \App\Http\Controllers\JobDescriptionController::class);
    Route::get('job-description/trash', [\App\Http\Controllers\JobDescriptionController::class, 'trash'])->name('job-description.trash');
    //Machine
    Route::resource('machine', \App\Http\Controllers\MachineController::class);
    Route::get('machine/trash', [\App\Http\Controllers\MachineController::class, 'trash'])->name('machine.trash');
    //Machine Type
    Route::resource('machine-type', \App\Http\Controllers\MachineTypeController::class);
    Route::get('machine-type/trash', [\App\Http\Controllers\MachineTypeController::class, 'trash'])
        ->name('machine-type.trash');
    //Maintenance
    Route::resource('maintenance', \App\Http\Controllers\MaintenanceController::class);
    //Maintenance Action
    Route::resource('maintenance-action', \App\Http\Controllers\MaintenanceActionController::class);
    //Maintenance Plan
    Route::resource('maintenance-plan', \App\Http\Controllers\MaintenancePlanController::class);
    //Maintenance Type
    Route::resource('maintenance-type', \App\Http\Controllers\MaintenanceTypeController::class);
    //Product
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    Route::get('product/trash', [\App\Http\Controllers\ProductController::class, 'trash'])->name('product.trash');
    //Product Type
    Route::resource('product-type', \App\Http\Controllers\ProductTypeController::class);
    Route::get('product-type/trash', [\App\Http\Controllers\ProductTypeController::class, 'trash'])->name('product-type.trash');
    //Product Quality Plan
    Route::resource('product-quality-plan', \App\Http\Controllers\ProductQualityPlanController::class);
    Route::get('product-quality-plan/trash', [\App\Http\Controllers\ProductQualityPlanController::class, 'trash'])->name('product-quality-plan.trash');
    //Recipe
    Route::resource('recipe', \App\Http\Controllers\RecipeController::class);
    Route::get('recipe/trash', [\App\Http\Controllers\RecipeController::class, 'trash'])->name('recipe.trash');
    //Raw Material
    Route::resource('raw-material', \App\Http\Controllers\RawMaterialController::class);
    Route::get('raw-material/trash', [\App\Http\Controllers\RawMaterialController::class, 'trash'])->name('raw-material.trash');
    //Raw Material Type
    Route::resource('raw-material-type', \App\Http\Controllers\RawMaterialTypeController::class);
    Route::get('raw-material-type/trash', [\App\Http\Controllers\RawMaterialController::class, 'trash'])->name('raw-material-type.trash');
    //Raw Material Quality Plan
    Route::resource('raw-material-quality-plan', \App\Http\Controllers\RawMaterialQaulityPlanController::class);
    Route::get('raw-material-quality-plan/trash', [\App\Http\Controllers\RawMaterialQaulityPlanController::class, 'trash'])->name('raw-material-quality-plan.trash');
    //Quality Spect
    Route::resource('quality-spect', \App\Http\Controllers\QualitySpectController::class);
    Route::get('quality-spect/trash', [\App\Http\Controllers\QualitySpectController::class, 'trash'])->name('quality-spect.trash');
    //Suppliers
    Route::resource('supplier', \App\Http\Controllers\SupplierController::class);
    //Audit
    Route::resource('audit', \App\Http\Controllers\AuditController::class);
    //Audit Type
    Route::resource('audit-type', \App\Http\Controllers\AuditTypeController::class);
    Route::get('audit-type/trash', [\App\Http\Controllers\AuditTypeController::class, 'trash'])->name('audit-type.trash');
    //Audit Plan
    Route::resource('audit-plan', \App\Http\Controllers\AuditPlanController::class);
    //Audit Firm
    Route::resource('audit-firm', \App\Http\Controllers\AuditFirmController::class);
    Route::get('audit-firm/trash', [\App\Http\Controllers\AuditFirmController::class, 'trash'])->name('audit-firm.trash');
    //Auditor
    Route::resource('auditor', \App\Http\Controllers\AuditorController::class);
    Route::get('auditor/trash', [\App\Http\Controllers\AuditorController::class, 'trash'])->name('auditor.trash');
    //Standard
    Route::resource('standard', \App\Http\Controllers\StandardController::class);
    Route::get('standard/trash', [\App\Http\Controllers\StandardController::class, 'trash'])->name('standard.trash');
    //Document
    Route::resource('document', \App\Http\Controllers\DocumentTypeController::class);
    //Document Type
    Route::resource('document-type', \App\Http\Controllers\DocumentTypeController::class);
    //Claim
    Route::resource('complaint', \App\Http\Controllers\ComplaintController::class);
    //Claim Type
    Route::resource('complaint-type', \App\Http\Controllers\ComplaintTypeController::class);
    //Claim Action
    Route::resource('complaint-action', \App\Http\Controllers\ComplaintActionController::class);
    //Claim Decision
    Route::resource('complaint-decision', \App\Http\Controllers\ComplaintDecisionController::class);
    //Claim Property
    Route::resource('complaint-property', \App\Http\Controllers\ComplaintPropertyController::class);
    //Customer
    Route::resource('customer', \App\Http\Controllers\CustomerController::class);
    Route::get('customer/trash', [\App\Http\Controllers\CustomerController::class, 'trash'])->name('customer.trash');
    //Measurement Tool
    Route::resource('measurement-tool', \App\Http\Controllers\MeasurementToolController::class);
    Route::get('measurement-tool/trash', [\App\Http\Controllers\MeasurementToolController::class, 'trash'])->name('measurement-tool.trash');
    //Measurement Tool Type
    Route::resource('measurement-tool-type', \App\Http\Controllers\MeasurementToolTypeController::class);
    Route::get('measurement-tool-type/trash', [\App\Http\Controllers\MeasurementToolTypeController::class, 'trash'])->name('measurement-tool-type.trash');
    //Measurement Tool Action
    Route::resource('measurement-tool-action', \App\Http\Controllers\MeasurementToolActionController::class);
    //Measurement Tool Property
    Route::resource('measurement-tool-property', \App\Http\Controllers\MeasurementToolPropertyController::class);

});



