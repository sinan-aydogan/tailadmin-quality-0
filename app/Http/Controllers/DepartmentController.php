<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Modules/Department/Index', [
            'tableData' => DepartmentResource::collection(Department::tableSearch($request->searchObj)),
            'searchDataManager' => User::relatedData('manager_id','departments')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Department/Create', [
            'users' => User::all(['id','name','profile_photo_path']),
            'departments' => Department::where('department_type', 1)->get(['id','name']),
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
        $attributes['creator_id'] = Auth::id();
        Department::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The department has been successfully created.</b><br><b>Department: </b>'.$request['name']]);
        return redirect()->route('department.index') ;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display a listing of the deleted resource.
     *
     * @return Response|\Inertia\Response
     */
    public function trash()
    {
        $content = Department::with('manager:id,name,profile_photo_path', 'department:id,name')->get(['id', 'name', 'manager_id', 'department_type', 'department_id', 'is_production', 'is_complaint']);

        return Inertia::render('Modules/Department/Index', [
            'tableData' => $content
        ]);
    }
}
