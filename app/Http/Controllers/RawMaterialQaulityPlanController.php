<?php

namespace App\Http\Controllers;

use App\Http\Resources\QualitySprectResource;
use App\Http\Resources\RawMaterialQualityPlanResource;
use App\Models\Department;
use App\Models\QualitySpect;
use App\Models\RawMaterial;
use App\Models\RawMaterialQualityPlan;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class RawMaterialQaulityPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*Quality Plans List*/
        $qualityPlans = RawMaterialQualityPlan::query()
            ->with(['spects:id,spect_id,limit_type_id,rule_id,value','spects.quality_spect:id,name'])
            ->when($request->code, fn($query,$code)=>$query->where('code','like',"%{$code}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->when($request->raw_material_id, fn($query,$raw_material_id)=>$query->where('raw_material_id',$raw_material_id))
            ->get();

        return Inertia::render('Modules/RawMaterial/QualityPlan/Index', [
            'tableData' => RawMaterialQualityPlanResource::collection($qualityPlans),
            'searchDataDepartment' => Department::relatedData('department_id','raw_material_quality_plans')->get(),
            'searchDataRawMaterial' => RawMaterial::relatedData('raw_material_id','raw_material_quality_plans')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/RawMaterial/QualityPlan/Create', [
            'departments' => Department::relatedData('department_id','raw_materials')->get(),
            'generalDepartments' => Department::where('is_production', 1)->get(),
            'standards' => Standard::all(['id', 'name']),
            'rawMaterials' => RawMaterial::where('department_id', $request->department_id)->get(),
            'spects' => QualitySprectResource::collection(QualitySpect::whereJsonContains('spect_type',2)->get())
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
        /*Creator ID Adding*/
        $request['creator_id'] = Auth::id();

        /*Create Record*/
        $item = RawMaterialQualityPlan::create($request->except('spects'));

        /*Spect Conversion*/
        $spects = collect($request->spects)->map(function($item){
            $item['creator_id'] = Auth::id();

            return $item;
        });

        /*Create Spects*/
        $item->spects()->createMany($spects);

        /*Feedback Message*/
        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The quality plan has been successfully created.</b><br><b>Quality Plan: </b>'.$request['code']]);
        return redirect()->route('raw-material-quality-plan.index') ;
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
