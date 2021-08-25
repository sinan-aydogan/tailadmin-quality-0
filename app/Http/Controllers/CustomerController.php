<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $customer = Customer::query()->when($request->name, fn($query,$name)=>$query->where('name','like',"%{$name}%"))
            ->when($request->tax_id, fn($query,$tax_id)=>$query->where('tax_id','like',"%{$tax_id}%"))
            ->when($request->phone, fn($query,$phone)=>$query->where('phone','like',"%{$phone}%"))
            ->when($request->status, fn($query,$status)=>$query->where('status',$status))
            ->get();

        return Inertia::render('Modules/Customer/Index',[
            'tableData'=>CustomerResource::collection($customer),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Modules/Customer/Create');
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
        Customer::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The customer has been successfully created.</b><br><b>Customer: </b>'.$request['name']]);
        return redirect()->route('customer.index') ;
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
