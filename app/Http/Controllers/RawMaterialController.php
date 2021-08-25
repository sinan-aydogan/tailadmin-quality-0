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
use Inertia\Inertia;

class RawMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('RawMaterial/Index',[
            'rawMaterials' => RawMaterialResource::collection(RawMaterial::all()),
            'departments' => Department::all(['id','name']),
            'rawMaterialTypes' => RawMaterial::all(['id','name'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('RawMaterial/Create',[
            'products'=> Product::all(['id','name']),
            'departments'=> Department::where('is_production',1)->get(['id','name']),
            'rawMaterialTypes'=> RawMaterialType::where('department_id', $request->departmentId)->get(['id','name']),
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
        $attributes['raw_material_type_id'] = $request->raw_material_type_id['id'];
        $attributes['department_id'] = $request->department_id['id'];
        $attributes['supplier_id'] = $request->supplier_id['id'];
        $attributes['creator_id'] = Auth::id();
        RawMaterial::create($attributes);
        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The raw material has been successfully created. The raw material created: '.$request->name ;

        return redirect()->route('raw-material.index')
            ->with('message', $message);
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
