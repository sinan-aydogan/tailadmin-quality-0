<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index()
    {
        $content = Department::with('manager:id,name,profile_photo_path','department:id,name')->get(['id','name','manager_id','department_type','department_id','is_production','is_complaint']);

        return Inertia::render('Department/Index',[
            'content'=>$content
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create()
    {
        $users = User::all();
        $departments = Department::where('department_type',0)->get();

        return Inertia::render('Department/Create',[
            'users'=>$users,
            'departments'=>$departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['manager_id'] = $request->manager_id['id'];
        $attributes['department_type'] = $request->department_type['value'];
       isset($request->department_id) ? $attributes['department_id'] = $request->department_id['id'] : $attributes['department_id'] = null;
        $attributes['is_complaint'] = $request->is_complaint['value'];
        $attributes['is_production'] = $request->is_production['value'];
        $attributes['creator_id'] = Auth::id();
        Department::create($attributes);
        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The department has been successfully created. The department created: '.$request->name ;

        return redirect()->route('department.index')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse|Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
