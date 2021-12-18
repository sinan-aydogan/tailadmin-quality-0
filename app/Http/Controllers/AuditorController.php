<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuditorResource;
use App\Models\AuditFirm;
use App\Models\Auditor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function index(Request $request)
    {
        /*Auditors List*/
        $auditors = Auditor::query()
            ->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->email, fn($query,$email)=>$query->where('email','like',"%{$email}%"))
            ->when($request->phone, fn($query,$phone)=>$query->where('phone','like',"%{$phone}%"))
            ->when($request->audit_firm_id, fn($query,$audit_firm_id)=>$query->where('audit_firm_id',$audit_firm_id))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        return Inertia::render('Modules/Regulation/Auditor/Index',[
            'tableData' => AuditorResource::collection(Auditor::all()),
            'searchDataFirm' => Auditor::relatedData('audit_firm_id','auditors')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Regulation/Auditor/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
