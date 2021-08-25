<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobDescriptionResource;
use App\Models\Department;
use App\Models\JobDescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        /*Job Descriptions List*/
        $jobDescription = JobDescription::query()->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->when($request->collar_type, fn($query,$collar_type)=>$query->where('collar_type',$collar_type))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        /*Job Description Department List*/
        $jobDescriptionDepartment = JobDescription::where('department_id', '!=', null)->get()->map(function ($jobDescription) {
            return $jobDescription->department_id;
        });
        $departments = Department::find($jobDescriptionDepartment,['id','name']);

        return Inertia::render('Modules/Staff/JobDescription/Index',[
            'tableData'=> JobDescriptionResource::collection($jobDescription),
            'searchDataDepartment'=> $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Staff/JobDescription/Create',[
            'staff'=>User::all(['id','name','profile_photo_path']),
            'departments'=>Department::all(['id','name']),
            'jobDescriptions'=>JobDescription::all(['id','name']),
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
        $attributes['creator_id'] = Auth::id();
        JobDescription::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The job description has been successfully created.</b><br><b>Title: </b>'.$request['name']]);
        return redirect()->route('job-description.index') ;
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
