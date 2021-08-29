<?php

namespace App\Http\Controllers;

use App\Models\QualitySpect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class QualitySpectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['creator_id'] = Auth::id();
        QualitySpect::create($attributes);

        Session::flash('toastr', ['type' => 'solid-green', 'position' => 'rb','content' => '<b>The department has been successfully created.</b><br><b>Department: </b>'.$request['name']]);
        return redirect()->back()->with('spectLoaading',false) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualitySpect  $qualitySpect
     * @return \Illuminate\Http\Response
     */
    public function show(QualitySpect $qualitySpect)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QualitySpect  $qualitySpect
     * @return \Illuminate\Http\Response
     */
    public function edit(QualitySpect $qualitySpect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QualitySpect  $qualitySpect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QualitySpect $qualitySpect)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualitySpect  $qualitySpect
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualitySpect $qualitySpect)
    {
        //
    }
}
