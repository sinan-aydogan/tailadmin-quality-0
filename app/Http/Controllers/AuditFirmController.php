<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditFirmResource;
use App\Models\AuditFirm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuditFirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        /*Audit Firm List*/
        $auditFirms = AuditFirm::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->email, fn($query,$email)=>$query->where('email','like',"%{$email}%"))
            ->when($request->phone, fn($query,$phone)=>$query->where('phone','like',"%{$phone}%"))
            ->when($request->audit_firm_type_id, fn($query,$audit_firm_type_id)=>$query->whereJsonContains('audit_firm_type_id',(int)$audit_firm_type_id))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        return Inertia::render('Modules/Regulation/AuditFirm/Index', [
            'tableData' => AuditFirmResource::collection($auditFirms)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Regulation/AuditFirm/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['creator_id'] = Auth::id();
        AuditFirm::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The audit firm has been successfully created.</b><br><b>Firm: </b>'.$request['name']]);
        return redirect()->route('audit-firm.index') ;
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
