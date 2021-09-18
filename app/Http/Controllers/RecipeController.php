<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\Property;
use App\Models\RawMaterial;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        /*Recipe List*/
        $recipes = Recipe::query()
            ->with(['recipeItems:id,raw_material_id,amount,unit','recipeItems.rawMaterial:id,name'])
            ->when($request->code, fn($query,$code)=>$query->where('code','like',"%{$code}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->when($request->product_id, fn($query,$product_id)=>$query->where('product_id',$product_id))
            ->get();

        return Inertia::render('Modules/Product/Recipe/Index',[
            'tableData' => RecipeResource::collection($recipes),
            'searchDataDepartment' => Department::relatedData('department_id','recipes')->get(),
            'searchDataProduct' => Product::relatedData('product_id','recipes')->get(),
            'recipeAmounts' => Property::query()->whereHas('propertyType', function (Builder $query) {
                $query->where('module_id',  4);
            })->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/Product/Recipe/Create',[
            'departments' => Department::relatedData('department_id','products')->get(),
            'generalDepartments' => Department::where('is_production', 1)->get(),
            'products' => Product::where('department_id', $request->department_id)->get(),
            'rawMaterials' => RawMaterial::where('department_id', $request->department_id)->get(['id','name']),
            'recipeAmounts' => Property::query()->whereHas('propertyType', function (Builder $query) {
                $query->where('module_id',  4);
            })->get()
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
        $item = Recipe::create($request->except('rawMaterials'));

        /*Recipe Item Conversion*/
        $recipeItems = collect($request->recipeItems)->map(function($item){
            $item['creator_id'] = Auth::id();

            return $item;
        });

        /*Create Recipe Items*/
        $item->recipeItems()->createMany($recipeItems);

        /*Feedback Message*/
        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The recipe has been successfully created.</b><br><b>Product: </b>'.$item->product->name]);
        return redirect()->route('recipe.index') ;
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
