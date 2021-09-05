<?php

namespace App\Http\Controllers;

use App\Http\Resources\RawMaterialResource;
use App\Models\Department;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\RawMaterialType;
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
            ->when($request->code, fn ($query, $code) => $query->where('code', 'like', "%{$code}%"))
            ->when($request->name, fn ($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->department_id, fn ($query, $department_id) => $query->where('department_id', $department_id))
            ->when($request->raw_material_type_id, fn ($query, $raw_material_type_id) => $query->where('raw_material_type_id', $raw_material_type_id))
            ->when($request->supplier_id, fn ($query, $supplier_id) => $query->where('supplier_id', $supplier_id))
            ->orderBy('created_at')
            ->get();

        return Inertia::render('Modules/RawMaterial/Index',[
            'tableData' => RawMaterialResource::collection($rawMaterials),
            'searchDataDepartment' => Department::relatedData('department_id','raw_materials')->get(),
            'searchDataType' => RawMaterialType::relatedData('raw_material_type_id','raw_materials')->get(),
            'searchDataSupplier' => Supplier::relatedData('supplier_id','raw_materials')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/RawMaterial/Create',[
            'departments'=> Department::where('is_production',1)->get(['id','name']),
            'rawMaterialTypes'=> RawMaterialType::all(['id','name']),
            'suppliers' => Supplier::all(['id','name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();

        $attributes['creator_id'] = Auth::id();
        RawMaterial::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The raw material has been successfully created.</b><br><b>Raw Material: </b>'.$request['name']]);
        return redirect()->route('raw-material.index') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
