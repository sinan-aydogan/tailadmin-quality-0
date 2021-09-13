<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*Property List*/
        $properties = Property::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->module_id, fn($query,$module_id)=>$query->whereHas('propertyType', function (Builder $query)use($module_id) {
                $query->where('module_id',  $module_id);
            }))
            ->when($request->property_type_id, fn($query,$property_type_id)=>$query->where('property_type_id',$property_type_id))
            ->orderByDesc('id')
            ->get(['id','name','property_type_id']);

        return Inertia::render('Settings/Property',[
            'tableData'=> $properties,
            'propertyTypes'=> PropertyType::orderByDesc('id')->get(['id','name','module_id']),
            'newPropertyTypes' => PropertyType::where('module_id',$request->new_module_id)->get(['id','name']),
            'newPropertyModules' => PropertyType::whereNotNull('module_id')->select('module_id')->distinct()->get()->map(function($item){return $item->module_id;})
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Property::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The department has been successfully created.</b><br><b>Department: </b>'.$request['name']]);
        return redirect()->back()->with('propertyLoading',false) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $rawMaterialProperty
     * @return \Illuminate\Http\Response
     */
    public function show(Property $rawMaterialProperty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $rawMaterialProperty
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $rawMaterialProperty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $rawMaterialProperty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $rawMaterialProperty)
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
            $property = Property::find($id);
            Property::destroy($id);
            Session::flash('toastr', ['type' => 'gradient-red-to-pink', 'position' => 'rb','content' => '<b>'.$property->name. '</b> deleted']);
            return redirect()->back() ;
    }
}
