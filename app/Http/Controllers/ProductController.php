<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        /* Products List */
        $products = Product::query()
            ->with(['standards:id,name,code'])
            ->when($request->code, fn ($query, $code) => $query->where('code', 'like', "%{$code}%"))
            ->when($request->name, fn ($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->product_type_id, fn ($query, $product_type_id) => $query->where('product_type_id', $product_type_id))
            ->when($request->department_id, fn ($query, $department_id) => $query->where('department_id', $department_id))
            ->when($request->standard_id, fn($query, $standard_id) => $query->whereHas('standards', function (Builder $query)use($standard_id) {
                $query->where('standard_id', $standard_id);
            }))
            ->when($request->is_certified, fn ($query, $is_certified) => $query->where('is_certified', $is_certified))
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Modules/Product/Index', [
            'tableData' => ProductResource::collection($products),
            'searchDataDepartment' => Department::relatedData('department_id', 'products')->get(['id','name']),
            'searchDataType' => ProductType::relatedData('product_type_id', 'products')->get(['id','name']),
            'searchDataStandard' => Standard::whereHas('products')->get(['id','code','name']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/Product/Create', [
            'departments' => Department::where('is_production', '=', 1)->get(['id', 'name']),
            'standards' => Standard::where('department_id', $request->department_id)->get(['id', 'code']),
            'productTypes' => ProductType::where('department_id', $request->department_id)->get(['id', 'name']),
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
        /*Creator ID Adding*/
        $request['creator_id'] = Auth::id();
        $standards = $request['standards'];

        /*Create Record*/
        $item = Product::create($request->except('standards'));

        /*Attach Standards*/
        foreach ($standards as $standard) {
            $item->standards()->attach($standard);
        }

        /*Product Photo*/
        if ($request->hasFile('photo')) {
            $attributes
                ->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb', 'content' => '<b>The product has been successfully created.</b><br><b>Product: </b>' . $request['name']]);
        return redirect()->route('product.index');
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
