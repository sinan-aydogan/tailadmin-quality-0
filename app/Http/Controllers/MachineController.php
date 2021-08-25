<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Machine;
use App\Models\MachineType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Machine/Index',[
            'machines'=>Machine::with('department:id,name','machine:id,name','machineType:id,name')->get(['id','code','name','department_id','machine_type_id','machine_id']),
            'departments'=>Department::all(['id','name'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Machine/Create',[
            'machines'=>Machine::all(),
            'machineTypes'=>MachineType::all(),
            'departments'=>Department::all(),
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
        isset($request->machine_type_id) ? $attributes['machine_type_id'] = $request->machine_type_id['id'] : $attributes['machine_type_id'] = null;
        isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        isset($request->machine_id) ? $attributes['machine_id'] = $request->machine_id['id'] : $attributes['machine_id'] = null;
        isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        $attributes['creator_id'] = Auth::id();
        Machine::create($attributes);
        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The machine has been successfully created. The machine created: '.$request->name ;

        return redirect()->route('machine.index')
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
