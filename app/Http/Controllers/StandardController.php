<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeasurementToolResource;
use App\Http\Resources\StandardResource;
use App\Models\Department;
use App\Models\Machine;
use App\Models\MeasurementTool;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*Departments List*/
        $standards = Standard::query()
            ->with(['departments:id,name'])
            ->with(['products:id,name,code'])
            ->with(['rawMaterials:id,name,code'])
            ->with(['machines:id,name,code'])
            ->with(['measurementTools:id,code,measurement_tool_type_id,serial_no','measurementTools.type:id,name'])
            ->when($request->code, fn($query,$code)=>$query->where('code','like',"%{$code}%"))
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->standard_type, fn($query,$standard_type)=>$query->where('standard_type',$standard_type))
            ->when($request->department_id, fn($query, $department_id) => $query->whereHas('departments', function (Builder $query) use ($department_id) {
                $query->where('id', $department_id);
            }))
            ->when($request->product_id, fn($query, $product_id) => $query->whereHas('products', function (Builder $query) use ($product_id) {
                $query->where('id', $product_id);
            }))
            ->when($request->raw_material_id, fn($query, $raw_material_id) => $query->whereHas('rawMaterials', function (Builder $query) use ($raw_material_id) {
                $query->where('id', $raw_material_id);
            }))
            ->when($request->machine_id, fn($query, $machine_id) => $query->whereHas('machines', function (Builder $query) use ($machine_id) {
                $query->where('id', $machine_id);
            }))
            ->when($request->measurement_tool_id, fn($query, $measurement_tool_id) => $query->whereHas('measurementTools', function (Builder $query) use ($measurement_tool_id) {
                $query->where('id', $measurement_tool_id);
            }))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        return Inertia::render('Modules/Regulation/Standard/Index', [
            'tableData' => StandardResource::collection($standards),
            'searchDataDepartment' => Department::whereHas('standards')->get(),
            'searchDataProduct' => Product::whereHas('standards')->get(),
            'searchDataRawMaterial' => RawMaterial::whereHas('standards')->get(),
            'searchDataMachine' => Machine::whereHas('standards')->get(),
            'searchDataMeasurementTool' => MeasurementTool::whereHas('standards')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Regulation/Standard/Create', [
            'standards' => Standard::all(['id','name','code']),
            'departments' => Department::all(['id','name']),
            'products' => Product::all(['id','name']),
            'rawMaterials' => RawMaterial::all(['id','name']),
            'machines' => Machine::all(['id','name','code']),
            'measurementTools' => MeasurementToolResource::collection(MeasurementTool::all())
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
        $departments = $request['departments'];
        $products = $request['products'];
        $rawMaterials = $request['raw_materials'];
        $machines = $request['machines'];
        $measurementTools = $request['measurement_tools'];

        /*Create Record*/
        $item = Standard::create($request->except(['related_departments', 'related_products', 'related_raw_materials','related_machines','related_measurement_tools']));

        /*Attach Department*/
        foreach ($departments as $department) {
            $item->departments()->attach($department);
        }
        /*Attach Products*/
        foreach ($products as $product) {
            $item->products()->attach($product);
        }
        /*Attach Raw Materials*/
        foreach ($rawMaterials as $rawMaterial) {
            $item->rawMaterials()->attach($rawMaterial);
        }
        /*Attach Machines*/
        foreach ($machines as $machine) {
            $item->machines()->attach($machine);
        }
        /*Attach Measurement Tools*/
        foreach ($measurementTools as $measurementTool) {
            $item->measurementTools()->attach($measurementTool);
        }

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The standard has been successfully created.</b><br><b>Code: </b>'.$request['code'].'</br>Name:'.$request['name']]);
        return redirect()->route('standard.index') ;
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
