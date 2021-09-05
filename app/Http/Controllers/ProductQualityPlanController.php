<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductQualityPlanResource;
use App\Http\Resources\QualitySprectResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductQualityPlan;
use App\Models\QualitySpect;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class ProductQualityPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response|Response
     */
    public function index(Request $request)
    {
        /*Quality Plans List*/
        $qualityPlans = ProductQualityPlan::query()
        ->with(['product_spects:id,spect_id,limit_type_id,rule_id,value','product_spects.quality_spect:id,name'])
        ->when($request->code, fn($query,$code)=>$query->where('code','like',"%{$code}%"))
        ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
        ->when($request->product_id, fn($query,$product_id)=>$query->where('product_id',$product_id))
        ->get();

        return Inertia::render('Modules/Product/QualityPlan/Index', [
            'tableData' => ProductQualityPlanResource::collection($qualityPlans),
            'searchDataDepartment' => Department::relatedData('department_id','product_quality_plans')->get(),
            'searchDataProduct' => Product::relatedData('product_id','product_quality_plans')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/Product/QualityPlan/Create', [
            'departments' => Department::relatedData('department_id','products')->get(),
            'generalDepartments' => Department::where('is_production', 1)->get(),
            'standards' => Standard::all(['id', 'name']),
            'products' => Product::where('department_id', $request->department_id)->get(),
            'spects' => QualitySprectResource::collection(QualitySpect::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /*Creator ID Adding*/
        $request['creator_id'] = Auth::id();

        /*Create Record*/
        $item = ProductQualityPlan::create($request->except('spects'));

        /*Spect Conversion*/
        $spects = collect($request->spects)->map(function($item){
            $item['creator_id'] = Auth::id();

            return $item;
        });

        /*Create Spects*/
        $item->product_spects()->createMany($spects);

        /*Feedback Message*/
        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The department has been successfully created.</b><br><b>Quality Plan: </b>'.$request['code']]);
        return redirect()->route('product-quality-plan.index') ;
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
