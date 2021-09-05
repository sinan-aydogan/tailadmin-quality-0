<?php

namespace App\Http\Controllers;

use App\Http\Resources\MachineTypeResource;
use App\Models\MachineType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Inertia\Response;

class MachineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        /*Machine Types List*/
        $machineTypes = MachineType::query()
            ->when($request->name, fn($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->description, fn($query, $description) => $query->where('description', 'like', "%{$description}%"))
            ->orderBy('created_at')
            ->get();

        return Inertia::render('Modules/Machine/MachineType/Index', [
            'tableData' => MachineTypeResource::collection($machineTypes)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Modules/Machine/MachineType/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['creator_id'] = Auth::id();

        MachineType::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb', 'content' => '<b>The machine type has been successfully created.</b><br><b>Machine Type: </b>' . $request['name']]);
        return redirect()->route('machine-type.index');
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
     * @param Request $request
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
