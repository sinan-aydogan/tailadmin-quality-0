<?php

namespace App\Http\Controllers;

use App\Http\Resources\MeasurementToolResource;
use App\Models\Department;
use App\Models\MeasurementTool;
use App\Models\MeasurementToolType;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class MeasurementToolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /*Measurement Tools List*/
        $tools = MeasurementTool::query()
            ->when($request->code, fn($query, $code) => $query->where('code', 'like', "%{$code}%"))
            ->when($request->serial_no, fn($query, $serial_no) => $query->where('serial_no', 'like', "%{$serial_no}%"))
            ->when($request->model, fn($query, $model) => $query->where('model', 'like', "%{$model}%"))
            ->when($request->manufacturer, fn($query, $manufacturer) => $query->where('manufacturer', 'like', "%{$manufacturer}%"))
            ->when($request->measurement_tool_type_id, fn($query, $measurement_tool_type_id) => $query->where('measurement_tool_type_id', $measurement_tool_type_id))
            ->when($request->supplier_id, fn($query, $supplier_id) => $query->where('supplier_id', $supplier_id))
            ->when($request->department_id, fn($query, $department_id) => $query->where('department_id', $department_id))
            ->when($request->operator_id, fn($query, $operator_id) => $query->where('operator_id', $operator_id))
            ->when($request->action_manager_id, fn($query, $action_manager_id) => $query->where('action_manager_id', $action_manager_id))
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Modules/MeasurementTool/Index', [
            'tableData' => MeasurementToolResource::collection($tools),
            'searchDataType' => MeasurementToolType::relatedData('measurement_tool_type_id','measurement_tools')->get(),
            'searchDataSupplier' => Supplier::relatedData('supplier_id','measurement_tools')->get(),
            'searchDataDepartment' => Department::relatedData('department_id','measurement_tools')->get(),
            'searchDataOperator' => User::relatedData('operator_id','measurement_tools')->get(),
            'searchDataActionManager' =>  User::relatedData('action_manager_id','measurement_tools')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/MeasurementTool/Create', [
            'types' => MeasurementToolType::all(['id', 'name']),
            'suppliers' => Supplier::all(['id', 'name']),
            'departments' => Department::all(['id', 'name']),
            'users' => User::all(['id', 'name', 'profile_photo_path'])
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
        //TODO CODE FIELD UNIQUE
        $attributes = $request->all();
        $toolType = MeasurementToolType::find($request->measurement_tool_type_id)->name;
        $attributes['creator_id'] = Auth::id();

        MeasurementTool::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb', 'content' => '<b>The measurement tool has been successfully created.</b><br><b>Tool: </b>' . $request['code'] . ' (' . $toolType . ')']);
        return redirect()->route('measurement-tool.index');
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
