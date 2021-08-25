<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobDescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
/*Mail Controller*/
use App\Mail\StaffRegister;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Staff/Index',[
            'staff'=>User::with('department:id,name','jobDescription:id,name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        $collarTypeId = $request->collarTypeId;
        return Inertia::render('Staff/Create',[
            'departments'=>Department::all(['id','name']),
            'jobDescriptions'=>JobDescription::where('collar_type',$collarTypeId)->get(['id','name']),
            'users'=>User::where('collar_type',1)->get(['id','name','profile_photo_path']),
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
        $request->department_id != null  && $attributes['department_id'] = $request->department_id['id'];
        $request->job_description_id != null  && $attributes['job_description_id'] = $request->job_description_id['id'];
        $request->collar_type != null  && $attributes['collar_type'] = $request->collar_type['value'];
        $request->manager_id != null  && $attributes['manager_id'] = $request->manager_id['id'];
        $request->status != null  && $attributes['status'] = $request->status['value'];
        $request->blood_group != null  && $attributes['blood_group'] = $request->blood_group['value'];
        $attributes['creator_id'] = Auth::id();
        $randomPassword = Str::random(8);
        $attributes['password'] = bcrypt($randomPassword);
        $mailData = [];
        $mailData['name'] = $request->name;
        $mailData['email'] = $request->email;
        $mailData['password'] = $randomPassword;
        User::create($attributes);

        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The staff has been successfully created. The staff created: '.$request->name ;

        Mail::to($request->email)->send(new StaffRegister($mailData));

        return redirect()->route('staff.index')
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
