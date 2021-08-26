<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductQualityPlanResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductQualityPlan;
use App\Models\QualitySpect;
use Illuminate\Http\Request;
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
            'tableData' => ProductQualityPlanResource::collection($qualityPlans)
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

        /*Quality Spects*/
        $spects = QualitySpect::where('spect_type', 1)->get(['id', 'name']);

        return Inertia::render('Modules/Product/QualityPlan/Create', [
            'departments' => $departments,
            'products' => $products,
            'spects' => $spects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
