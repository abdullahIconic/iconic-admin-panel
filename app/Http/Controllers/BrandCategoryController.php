<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandCategoryRequest;
use App\Http\Requests\UpdateBrandCategoryRequest;
use App\Models\BrandCategory;

class BrandCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreBrandCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BrandCategory $brandCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandCategory $brandCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandCategoryRequest  $request
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandCategoryRequest $request, BrandCategory $brandCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BrandCategory  $brandCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandCategory $brandCategory)
    {
        //
    }
}
