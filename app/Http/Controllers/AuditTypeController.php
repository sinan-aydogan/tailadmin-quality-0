<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditTypeResource;
use App\Models\AuditFirm;
use App\Models\AuditType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuditTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index()
    {
        /*Audit Types List*/
        $types = AuditType::with('firms:id,name')->get();

        return Inertia::render('Modules/Regulation/AuditType/Index', [
            'tableData' => AuditTypeResource::collection($types),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Regulation/AuditType/Create', [
            'firms' => AuditFirm::all(['id', 'name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*Creator ID Adding*/
        $request['creator_id'] = Auth::id();
        $firms = $request['audit_firms'];

        /*Create Record*/
        $item = AuditType::create($request->except(['audit_firms']));

        /*Attach Firms*/
        foreach ($firms as $firm) {
            $item->firms()->attach($firm);
        }

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The audit type has been successfully created.</b><br><b>Type: </b>'.$request['name']]);
        return redirect()->route('audit-type.index') ;
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
