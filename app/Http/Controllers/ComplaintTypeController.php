<?php

namespace App\Http\Controllers;

use App\Models\ComplaintType;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ComplaintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Complaint/ComplaintType/Index',[
            'departments' => Department::where('is_production',1)->get(['id','name']),
            'complaintTypes' => ComplaintType::with('department:id,name')->get(['id','name','critical_level','department_id']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Complaint/ComplaintType/Create',[
            'departments'=>Department::where('is_complaint',1)->get(['id','name']),
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
        isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        $attributes['creator_id'] = Auth::id();
        ComplaintType::create($attributes);
        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The complaint type has been successfully created. The complaint type created: '.$request->name ;

        return redirect()->route('complaint-type.index')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintType $complaintType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintType $complaintType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintType  $complaintType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintType $complaintType)
    {
        //
    }
}
