<?php

namespace App\Http\Controllers;

use App\Http\Resources\RawMaterialResource;
use App\Models\Department;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\RawMaterialType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /* Raw Materials List */
        $rawMaterials = RawMaterial::query()
            ->when($request->code, fn($query, $code) => $query->where('code', 'like', "%{$code}%"))
            ->when($request->name, fn($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->manufacturer, fn($query, $manufacturer) => $query->where('manufacturer', 'like', "%{$manufacturer}%"))
            ->when($request->model, fn($query, $model) => $query->where('model', 'like', "%{$model}%"))
            ->when($request->department_id, fn($query, $department_id) => $query->where('department_id', $department_id))
            ->when($request->raw_material_type_id, fn($query, $raw_material_type_id) => $query->where('raw_material_type_id', $raw_material_type_id))
            ->when($request->supplier_id, fn($query, $supplier_id) => $query->whereHas('suppliers', function (Builder $query)use($supplier_id) {
                $query->where('supplier_id', $supplier_id);
            }))
            ->orderByDesc('id')
            ->get();

        return Inertia::render('Modules/RawMaterial/Index', [
            'tableData' => RawMaterialResource::collection($rawMaterials),
            'propertyTypes' => PropertyType::where('module_id',2)->get(['id','name']),
            'searchDataDepartment' => Department::relatedData('department_id', 'raw_materials')->get(),
            'searchDataType' => RawMaterialType::relatedData('raw_material_type_id', 'raw_materials')->get(),
            'searchDataSupplier' => Supplier::whereHas('rawMaterials')->get(),
            'searchDataPackage' => Property::where('property_type_id', 1)->get(['id', 'name', 'property_type_id']),
            'searchDataStocking' => Property::where('property_type_id', 2)->get(['id', 'name', 'property_type_id'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/RawMaterial/Create', [
            'departments' => Department::where('is_production', 1)->get(['id', 'name']),
            'types' => RawMaterialType::all(['id', 'name']),
            'suppliers' => Supplier::all(['id', 'name']),
            'propertyTypes' => PropertyType::where('module_id',2)->with('properties:id,name,property_type_id')->get(['id','name'])
        ]);
    }

/*Property::whereHas('propertyType', function (Builder $query){ $query->where('module_id',  2);
})->get(['id', 'name', 'property_type_id']),*/

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Creator ID Adding*/
        $request['creator_id'] = Auth::id();
        $suppliers = $request['suppliers'];

        /*Create Record*/
        $item = RawMaterial::create($request->except(['suppliers','stock_rules','package_types']));

        /*Attach Suppliers*/
        foreach ($suppliers as $supplier) {
            $item->suppliers()->attach($supplier);
        }
        /*Attach Properties*/
        foreach ($request['properties'] as $property) {
            $item->properties()->attach($property);
        }

        /*Raw Material Files*/
        if ($request->hasFile('files')) {
            foreach ($request['files'] as $file){
                $item
                    ->addMedia($file)
                    ->sanitizingFileName(function($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })
                    ->toMediaCollection('file');
            }
        }

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb', 'content' => '<b>The raw material has been successfully created.</b><br><b>Raw Material: </b>' . $request['name']]);
        return redirect()->route('raw-material.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
