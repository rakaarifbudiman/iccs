<?php

namespace App\Http\Controllers;

use App\Models\RDMS\RDMSUom;
use App\Http\Requests\StoreRDMSUomRequest;
use App\Http\Requests\UpdateRDMSUomRequest;

class RDMSUomController extends Controller
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
     * @param  \App\Http\Requests\StoreRDMSUomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRDMSUomRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RDMSUom  $rDMSUom
     * @return \Illuminate\Http\Response
     */
    public function show(RDMSUom $rDMSUom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RDMSUom  $rDMSUom
     * @return \Illuminate\Http\Response
     */
    public function edit(RDMSUom $rDMSUom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRDMSUomRequest  $request
     * @param  \App\Models\RDMSUom  $rDMSUom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRDMSUomRequest $request, RDMSUom $rDMSUom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RDMSUom  $rDMSUom
     * @return \Illuminate\Http\Response
     */
    public function destroy(RDMSUom $rDMSUom)
    {
        //
    }
}
