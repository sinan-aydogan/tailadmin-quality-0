<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Standard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductController extends Controller
{
    use InteractsWithMedia;
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->code, fn($query,$code)=>$query->where('code','like',"%{$code}%"))
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->product_type_id, fn($query,$product_type_id)=>$query->where('product_type_id',$product_type_id))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->when($request->standard_id, fn($query,$standard_id)=>$query->where('standard_id',$standard_id))
            ->when($request->is_certified, fn($query,$is_certified)=>$query->where('is_certified',$is_certified))
            ->orderBy('created_at')
            ->get();

        /*Product Types List*/
        $productProductType = Product::where('product_type_id', '!=', null)->get()->map(function ($product) {
            return $product->product_type_id;
        });
        $productTypes = ProductType::find($productProductType,['id','name']);

        /*Product Department List*/
        $productDepartment = Product::where('department_id', '!=', null)->get()->map(function ($product) {
            return $product->department_id;
        });
        $departments = Department::find($productDepartment,['id','name']);

        /*Product Standard List*/
        $productStandard = Product::where('standard_id', '!=', null)->get()->map(function ($product) {
            return $product->standard_id;
        });
        $standards = Standard::find($productStandard,['id','name']);

        return Inertia::render('Modules/Product/Index',[
            'tableData'=>ProductResource::collection($products),
            'searchDataDepartment'=>$departments,
            'searchDataType' => $productTypes,
            'searchDataStandard' => $standards
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        $department_id = $request->department_id;
        $departments = Department::where('is_production','=', 1)->get(['id','name']);
        $standards = Standard::where('department_id',$department_id)->get(['id','code']);
        $productTypes = ProductType::where('department_id',$department_id)->get(['id','name']);


        return Inertia::render('Modules/Product/Create',[
            'departments'=> $departments,
            'standards'=> $standards,
            'productTypes' => $productTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = new Product($request->all());
        $attributes['creator_id'] = Auth::id();
        $attributes->save();

        /*Product Photo*/
        if($request->hasFile('photo')){
            $attributes
                ->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The product has been successfully created.</b><br><b>Product: </b>'.$request['name']]);
        return redirect()->route('product.index') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response|\Inertia\Response
     */
    public function destroy($id)
    {
        //
    }
}
