<?php

namespace App\Http\Controllers\RDMS;

use App\Models\RDMS\SAPPrefix;
use App\Http\Requests\StoreSAPPrefixRequest;
use App\Http\Requests\UpdateSAPPrefixRequest;

class SAPPrefixController extends Controller
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
     * @param  \App\Http\Requests\StoreSAPPrefixRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSAPPrefixRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SAPPrefix  $sAPPrefix
     * @return \Illuminate\Http\Response
     */
    public function show(SAPPrefix $sAPPrefix)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SAPPrefix  $sAPPrefix
     * @return \Illuminate\Http\Response
     */
    public function edit(SAPPrefix $sAPPrefix)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSAPPrefixRequest  $request
     * @param  \App\Models\SAPPrefix  $sAPPrefix
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSAPPrefixRequest $request, SAPPrefix $sAPPrefix)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SAPPrefix  $sAPPrefix
     * @return \Illuminate\Http\Response
     */
    public function destroy(SAPPrefix $sAPPrefix)
    {
        //
    }
}
