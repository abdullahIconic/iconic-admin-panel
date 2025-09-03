<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceSafetyRequest;
use App\Http\Requests\UpdateServiceSafetyRequest;
use App\Models\ServiceSafety;

class ServiceSafetyController extends Controller
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
     * @param  \App\Http\Requests\StoreServiceSafetyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceSafetyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceSafety  $serviceSafety
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceSafety $serviceSafety)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceSafety  $serviceSafety
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceSafety $serviceSafety)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServiceSafetyRequest  $request
     * @param  \App\Models\ServiceSafety  $serviceSafety
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceSafetyRequest $request, ServiceSafety $serviceSafety)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceSafety  $serviceSafety
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceSafety $serviceSafety)
    {
        //
    }
}
