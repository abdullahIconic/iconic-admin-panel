<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandBranchRequest;
use App\Http\Requests\UpdateBrandBranchRequest;
use App\Models\BrandBranch;

class BrandBranchController extends Controller
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
     * @param  \App\Http\Requests\StoreBrandBranchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandBranchRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandBranch  $brandBranch
     * @return \Illuminate\Http\Response
     */
    public function show(BrandBranch $brandBranch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandBranch  $brandBranch
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandBranch $brandBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandBranchRequest  $request
     * @param  \App\Models\BrandBranch  $brandBranch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandBranchRequest $request, BrandBranch $brandBranch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandBranch  $brandBranch
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandBranch $brandBranch)
    {
        //
    }
}
