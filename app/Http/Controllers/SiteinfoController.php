<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteinfoRequest;
use App\Http\Requests\UpdateSiteinfoRequest;
use App\Models\Siteinfo;

class SiteinfoController extends Controller
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
     * @param  \App\Http\Requests\StoreSiteinfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteinfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Siteinfo $siteinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Siteinfo $siteinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiteinfoRequest  $request
     * @param  \App\Models\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteinfoRequest $request, Siteinfo $siteinfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siteinfo  $siteinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siteinfo $siteinfo)
    {
        //
    }
}
