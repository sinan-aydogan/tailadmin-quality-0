<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Complaint/Index',[
            'complaints' => Complaint::with('department:id,name','customer:id,name','product:id,name','complaintTypes:id,name')->get(['id','customer_id','department_id','product_id','register_date','status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Complaint/Create',[
            'customers' => Customer::all(['id','name']),
            'departments' => Department::where('is_complaint',1)->get(['id','name']),
            'products' => Product::where('department_id',$request->departmentID)->get(['id','name']),
            'complaints' => ComplaintType::where('department_id',$request->departmentID)->get(['id','name']),
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
        $attributes = new Complaint($request->all());
        $attributes['creator_id'] = Auth::id();
        $item = $attributes->save();

        /*Attach Complaint Types*/
        Complaint::find($attributes->id)->complaints()->attach($request->complaints);

        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The product has been successfully created. The product created: '.$request->name ;

        return redirect()->route('complaint.index')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
