<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffResource;
use App\Models\Department;
use App\Models\JobDescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
    public function index(Request $request)
    {
        /*Staff List*/
        $staff = User::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->department_id, fn($query,$department_id)=>$query->where('department_id',$department_id))
            ->when($request->job_description_id, fn($query,$job_description_id)=>$query->where('job_description_id',$job_description_id))
            ->when($request->manager_id, fn($query,$manager_id)=>$query->where('manager_id',$manager_id))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        return Inertia::render('Modules/Staff/Index', [
            'tableData' => StaffResource::collection($staff),
            'searchDataManager' => User::relatedData('manager_id','users')->get(),
            'searchDataDepartment' => Department::relatedData('department_id','users')->get(),
            'searchDataJobDescription' => JobDescription::relatedData('job_description_id','users')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Modules/Staff/Create', [
            'departments' => Department::all(['id', 'name']),
            'jobDescriptions' => JobDescription::where('collar_type', '=',$request->collar_type)->get(['id', 'name']),
            'managers' => User::all(['id', 'name', 'profile_photo_path']),
            'staff' => User::where('id','!=', $request->manager_id)->get(['id', 'name', 'profile_photo_path']),
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
        $randomPassword = Str::random(8);
        $attributes['password'] = bcrypt($randomPassword);
        $mailData = [];
        $mailData['name'] = $request->name;
        $mailData['email'] = $request->email;
        $mailData['password'] = $randomPassword;
        User::create($attributes);

        Mail::to($request->email)->send(new StaffRegister($mailData));


        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The staff has been successfully created.</b><br><b>Staff: </b>'.$request['name']]);
        return redirect()->route('staff.index') ;
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
