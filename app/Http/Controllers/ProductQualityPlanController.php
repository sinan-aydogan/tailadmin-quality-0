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
        $qualityPlans = ProductQualityPlan::all();

        return Inertia::render('Modules/Product/QualityPlan/Index', [
            'tableData' => ProductQualityPlanResource::collection($qualityPlans),
            'searchDataDepartment' => Department::where('is_production', 1)->get(),
            'searchDataProduct' => Product::where('department_id', $request->department_id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $department_id = $request->department_id;

        /*Products List*/
        $products = Product::where('department_id', $department_id)->get();

        /*Product Department List*/
        $productDepartment = Product::where('department_id', '!=', null)->get()->map(function ($product) {
            return $product->department_id;
        });
        $departments = Department::find($productDepartment, ['id', 'name']);

        /*General Department List*/
        $generalDepartments = Department::where('is_production', 1)->get();

        /*Standards*/
        $standards = Standard::all(['id', 'name']);

        /*Quality Spects*/
        $spects = QualitySprectResource::collection(QualitySpect::all());

        return Inertia::render('Modules/Product/QualityPlan/Create', [
            'departments' => $departments,
            'generalDepartments' => $generalDepartments,
            'standards' => $standards,
            'products' => $products,
            'spects' => $spects
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
        $item->spects()->createMany($spects);

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
