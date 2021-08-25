<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ComplaintActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Complaint/ComplaintAction/Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Inertia::render('Complaint/ComplaintAction/Create',[
            'complaints' => Complaint::with('customer','product')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = new ComplaintAction($request->all());
        $request->complaint_id != null ? $attributes['complaint_id'] = $request->complaint_id['id'] : '';
        $request->action_type != null ? $attributes['action_type'] = $request->action_type['value'] : '';
        $attributes['creator_id'] = Auth::id();
        $item = $attributes->save();

        $message = [];
        $message['type'] = 'success' ;
        $message['content'] = 'The complaint action has been successfully created.';

        return redirect()->route('complaint-action.index')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintAction  $complaintAction
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintAction $complaintAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintAction  $complaintAction
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintAction $complaintAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComplaintAction  $complaintAction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComplaintAction $complaintAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintAction  $complaintAction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintAction $complaintAction)
    {
        //
    }
}
