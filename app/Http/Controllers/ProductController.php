<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Standard;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return Inertia::render('Product/Index',[
            'departments'=>Department::where('is_production',1)->get(['id','name']),
            'products'=>ProductResource::collection(Product::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Product/Create',[
            'departments'=> Department::where('is_production',1)->get(),
            'standards'=>Standard::where('department_id',$request->departmentId)->get(['id','code']),
            'productTypes' => ProductType::where('department_id',$request->departmentId)->get(['id','name']),
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
        $attributes['product_type_id'] = $request->product_type_id['id'];
        isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        $attributes['is_certified'] = $request->is_certified['value'];
        isset($request->standard_id) ? $attributes['standard_id'] = $request->standard_id['id'] : $attributes['standard_id'] = null;
        $attributes['creator_id'] = Auth::id();
        $attributes->save();

        /*Product Photo*/
        if($request->hasFile('photo')){
            $attributes
                ->addMediaFromRequest('photo')
                ->toMediaCollection('photo');
        }

        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The product has been successfully created. The product created: '.$request->name ;

        return redirect()->route('product.index')
            ->with('message', $message);
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
