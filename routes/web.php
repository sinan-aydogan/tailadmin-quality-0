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


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('/');

    /*Settings Route*/
    Route::prefix('settings')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Settings/Index', [
                'users_count' => count(\App\Models\User::all('id')),
                'roles_count' => count(Role::all()),
                'permissions_count' => count(Permission::all())
            ]);
        })->name('settings');
        Route::resource('settings-user', \App\Http\Controllers\Settings\UserController::class);
        Route::get('role', function () {
            return Inertia::render('Settings/Role');
        })->name('settings-role');
        Route::get('permission', function () {
            return Inertia::render('Settings/Permission');
        })->name('settings-permission');
        Route::get('system', function () {
            return Inertia::render('Settings/System');
        })->name('settings-system');
        /*Property Management*/
        Route::resource('settings-property', \App\Http\Controllers\Settings\PropertyController::class);
        Route::resource('settings-property-type', \App\Http\Controllers\Settings\PropertyTypeController::class);
    });


    /*LaraQuality Resource Routes*/
    Route::resources([
        'department' => \App\Http\Controllers\DepartmentController::class,
        'staff' => \App\Http\Controllers\StaffController::class,
        'job-description' => \App\Http\Controllers\JobDescriptionController::class,
        'machine' => \App\Http\Controllers\MachineController::class,
        'machine-type' => \App\Http\Controllers\MachineTypeController::class,
        'maintenance' => \App\Http\Controllers\MaintenanceController::class,
        'maintenance-action' => \App\Http\Controllers\MaintenanceActionController::class,
        'maintenance-plan' => \App\Http\Controllers\MaintenancePlanController::class,
        'maintenance-type' => \App\Http\Controllers\MaintenanceTypeController::class,
        'product' => \App\Http\Controllers\ProductController::class,
        'product-type' => \App\Http\Controllers\ProductTypeController::class,
        'product-quality-plan' => \App\Http\Controllers\ProductQualityPlanController::class,
        'recipe' => \App\Http\Controllers\RecipeController::class,
        'raw-material' => \App\Http\Controllers\RawMaterialController::class,
        'raw-material-type' => \App\Http\Controllers\RawMaterialTypeController::class,
        'raw-material-quality-plan' => \App\Http\Controllers\RawMaterialQaulityPlanController::class,
        'quality-spect' => \App\Http\Controllers\QualitySpectController::class,
        'supplier' => \App\Http\Controllers\SupplierController::class,
        'audit' => \App\Http\Controllers\AuditController::class,
        'audit-type' => \App\Http\Controllers\AuditTypeController::class,
        'audit-plan' => \App\Http\Controllers\AuditPlanController::class,
        'audit-firm' => \App\Http\Controllers\AuditFirmController::class,
        'auditor' => \App\Http\Controllers\AuditorController::class,
        'standard' => \App\Http\Controllers\StandardController::class,
        'document' => \App\Http\Controllers\DocumentTypeController::class,
        'document-type' => \App\Http\Controllers\DocumentTypeController::class,
        'complaint' => \App\Http\Controllers\ComplaintController::class,
        'complaint-type' => \App\Http\Controllers\ComplaintTypeController::class,
        'complaint-action' => \App\Http\Controllers\ComplaintActionController::class,
        'complaint-decision' => \App\Http\Controllers\ComplaintDecisionController::class,
        'complaint-property' => \App\Http\Controllers\ComplaintPropertyController::class,
        'customer' => \App\Http\Controllers\CustomerController::class,
        'measurement-tool' => \App\Http\Controllers\MeasurementToolController::class,
        'measurement-tool-type' => \App\Http\Controllers\MeasurementToolTypeController::class,
        'measurement-tool-action' => \App\Http\Controllers\MeasurementToolActionController::class,
        'measurement-tool-property' => \App\Http\Controllers\MeasurementToolPropertyController::class
    ]);

    /*Custom Routes: Search Index, Deleted Items*/
    //Department
    Route::post('department', [\App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
    Route::get('department/trash', [\App\Http\Controllers\DepartmentController::class, 'trash'])->name('department.trash');
    //Staff
    Route::post('staff', [\App\Http\Controllers\StaffController::class, 'index'])->name('staff.index');
    Route::get('staff/trash', [\App\Http\Controllers\StaffController::class, 'trash'])->name('staff.trash');
    //Job Description
    Route::post('job-description', [\App\Http\Controllers\JobDescriptionController::class, 'index'])->name('job-description.index');
    Route::get('job-description/trash', [\App\Http\Controllers\JobDescriptionController::class, 'trash'])->name('job-description.trash');
    //Machine
    Route::get('machine/trash', [\App\Http\Controllers\MachineController::class, 'trash'])->name('machine.trash');
    //Machine Type
    Route::get('machine-type/trash', [\App\Http\Controllers\MachineTypeController::class, 'trash'])->name('machine-type.trash');
    //Maintenance
    Route::get('maintenance/trash', [\App\Http\Controllers\MaintenanceController::class, 'trash'])->name('maintenance.trash');
    //Maintenance Action
    Route::get('maintenance-action/trash', [\App\Http\Controllers\MaintenanceActionController::class, 'trash'])->name('maintenance-action.trash');
    //Maintenance Plan
    Route::get('maintenance-plan/trash', [\App\Http\Controllers\MaintenancePlanController::class, 'trash'])->name('maintenance-plan.trash');
    //Maintenance Type
    Route::get('maintenance-type/trash', [\App\Http\Controllers\MaintenanceTypeController::class, 'trash'])->name('maintenance-type.trash');
    //Product
    Route::get('product/trash', [\App\Http\Controllers\ProductController::class, 'trash'])->name('product.trash');
    //Product Type
    Route::get('product-type/trash', [\App\Http\Controllers\ProductTypeController::class, 'trash'])->name('product-type.trash');
    //Product Quality Plan
    Route::get('product-quality-plan/trash', [\App\Http\Controllers\ProductQualityPlanController::class, 'trash'])->name('product-quality-plan.trash');
    //Recipe
    Route::get('recipe/trash', [\App\Http\Controllers\RecipeController::class, 'trash'])->name('recipe.trash');
    //Raw Material
    Route::get('raw-material/trash', [\App\Http\Controllers\RawMaterialController::class, 'trash'])->name('raw-material.trash');
    //Raw Material Type
    Route::get('raw-material-type/trash', [\App\Http\Controllers\RawMaterialController::class, 'trash'])->name('raw-material-type.trash');
    //Raw Material Quality Plan
    Route::get('raw-material-quality-plan/trash', [\App\Http\Controllers\RawMaterialQaulityPlanController::class, 'trash'])->name('raw-material-quality-plan.trash');
    //Quality Spect
    Route::get('quality-spect/trash', [\App\Http\Controllers\QualitySpectController::class, 'trash'])->name('quality-spect.trash');
    //Suppliers
    Route::get('supplier/trash', [\App\Http\Controllers\SupplierController::class, 'trash'])->name('supplier.trash');
    //Audit
    Route::get('audit/trash', [\App\Http\Controllers\AuditController::class, 'trash'])->name('audit.trash');
    //Audit Type
    Route::get('audit-type/trash', [\App\Http\Controllers\AuditTypeController::class, 'trash'])->name('audit-type.trash');
    //Audit Plan
    Route::get('audit-plan/trash', [\App\Http\Controllers\AuditPlanController::class, 'trash'])->name('audit-plan.trash');
    //Audit Firm
    Route::get('audit-firm/trash', [\App\Http\Controllers\AuditFirmController::class, 'trash'])->name('audit-firm.trash');
    //Auditor
    Route::get('auditor/trash', [\App\Http\Controllers\AuditorController::class, 'trash'])->name('auditor.trash');
    //Standard
    Route::get('standard/trash', [\App\Http\Controllers\StandardController::class, 'trash'])->name('standard.trash');
    //Document
    Route::get('document/trash', [\App\Http\Controllers\DocumentController::class, 'trash'])->name('document.trash');
    //Document Type
    Route::get('document-type/trash', [\App\Http\Controllers\DocumentTypeController::class, 'trash'])->name('document-type.trash');
    //Claim
    Route::get('complaint/trash', [\App\Http\Controllers\ComplaintController::class, 'trash'])->name('complaint.trash');
    //Claim Type
    Route::get('complaint-type/trash', [\App\Http\Controllers\ComplaintTypeController::class, 'trash'])->name('complaint-type.trash');
    //Claim Action
    Route::get('complaint-action/trash', [\App\Http\Controllers\ComplaintActionController::class, 'trash'])->name('complaint-action.trash');
    //Claim Decision
    Route::get('complaint-decision/trash', [\App\Http\Controllers\ComplaintDecisionController::class, 'trash'])->name('complaint-decision.trash');
    //Claim Property
    Route::get('complaint-property/trash', [\App\Http\Controllers\ComplaintPropertyController::class, 'trash'])->name('complaint-property.trash');
    //Customer
    Route::get('customer/trash', [\App\Http\Controllers\CustomerController::class, 'trash'])->name('customer.trash');
    //Measurement Tool
    Route::get('measurement-tool/trash', [\App\Http\Controllers\MeasurementToolController::class, 'trash'])->name('measurement-tool.trash');
    //Measurement Tool Type
    Route::get('measurement-tool-type/trash', [\App\Http\Controllers\MeasurementToolTypeController::class, 'trash'])->name('measurement-tool-type.trash');
    //Measurement Tool Action
    Route::get('measurement-tool-action/trash', [\App\Http\Controllers\MeasurementToolActionController::class, 'trash'])->name('measurement-tool-action.trash');
    //Measurement Tool Property
    Route::get('measurement-tool-property/trash', [\App\Http\Controllers\MeasurementToolPropertyController::class, 'trash'])->name('measurement-tool-property.trash');

});



