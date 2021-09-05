<?php

namespace App\Http\Controllers;

use App\Http\Resources\MachineResource;
use App\Models\Department;
use App\Models\Machine;
use App\Models\MachineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /*Machines List*/
        $machines = Machine::query()->when($request->code, fn ($query, $code) => $query->where('code', 'like', "%{$code}%"))
            ->when($request->name, fn ($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->model, fn ($query, $model) => $query->where('model', 'like', "%{$model}%"))
            ->when($request->manufacturer, fn ($query, $manufacturer) => $query->where('manufacturer', 'like', "%{$manufacturer}%"))
            ->when($request->machine_type_id, fn ($query, $machine_type_id) => $query->where('machine_type_id', $machine_type_id))
            ->when($request->department_id, fn ($query, $department_id) => $query->where('department_id', $department_id))
            ->when($request->machine_id, fn ($query, $machine_id) => $query->where('machine_id', $machine_id))
            ->orderBy('created_at')
            ->get();

        return Inertia::render('Modules/Machine/Index', [
            'tableData' => MachineResource::collection($machines),
            'searchDataMachineType' => MachineType::relatedData('machine_type_id', 'machines')->get(),
            'searchDataDepartment' => Department::relatedData('department_id', 'machines')->get(),
            'searchDataMachine' => Machine::relatedData('machine_id', 'machines')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Machine/Create', [
            'machines' => Machine::all(['id', 'name']),
            'machineTypes' => MachineType::all(['id', 'name']),
            'departments' => Department::all(['id', 'name']),
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
        $attributes = $request->all();
        $attributes['creator_id'] = Auth::id();
        Machine::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb', 'content' => '<b>The machine has been successfully created.</b><br><b>Machine: </b>' . $request['name']]);
        return redirect()->route('machine.index');
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
