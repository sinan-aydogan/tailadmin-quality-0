<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductTypeResource;
use App\Models\Department;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /*Product Type List*/
        $types = ProductType::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->get();

        /*Product Type Department List*/
        $typeDepartment = ProductType::where('department_id', '!=', null)->get()->map(function ($type) {
            return $type->department_id;
        });
        $departments = Department::find($typeDepartment,['id','name']);

        return Inertia::render('Modules/Product/Type/Index',[
            'tableData'=>ProductTypeResource::collection($types),
            'searchDataDepartment'=>$departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/Product/Type/Create',[
            'departments'=>Department::all(['id','name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['department_id'] = $request->department_id['id'];
        $attributes['creator_id'] = Auth::id();
        ProductType::create($attributes);

        $message = [];
        $message['type'] = "success";
        $message['content'] = 'The product type has been successfully created. The product type created: '.$request->name ;

        return redirect()->route('product-type.index')
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
