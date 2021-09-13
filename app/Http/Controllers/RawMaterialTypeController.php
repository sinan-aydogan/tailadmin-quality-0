<?php

namespace App\Http\Controllers;

use App\Http\Resources\RawMaterialTypeResource;
use App\Models\Department;
use App\Models\RawMaterialType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class RawMaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /*Raw Material Type List*/
        $types = RawMaterialType::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->get();

        /* Raw Material Types List */
        return Inertia::render('Modules/RawMaterial/Type/Index',[
            'tableData' => RawMaterialTypeResource::collection($types),
            'searchDataDepartment' => Department::relatedData('department_id','raw_material_types')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/RawMaterial/Type/Create',[
            'departments' => Department::where('is_production',1)->get(['id','name'])
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
        RawMaterialType::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The raw material type has been successfully created.</b><br><b>Type: </b>'.$request['name']]);
        return redirect()->route('raw-material-type.index') ;
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
