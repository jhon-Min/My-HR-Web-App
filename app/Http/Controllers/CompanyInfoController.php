<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyInfoRequest;
use App\Http\Requests\UpdateCompanyInfoRequest;
use App\Models\CompanyInfo;

class CompanyInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
     * @param  \App\Http\Requests\StoreCompanyInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyInfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyInfo  $companyInfo
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyInfo $companyInfo)
    {
        return view('company-info.index', compact('companyInfo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyInfo  $companyInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyInfo $companyInfo)
    {
        return view('company-info.edit', compact('companyInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyInfoRequest  $request
     * @param  \App\Models\CompanyInfo  $companyInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyInfoRequest $request, CompanyInfo $companyInfo)
    {
        $companyInfo->name = $request->name;
        $companyInfo->email = $request->email;
        $companyInfo->phone = $request->phone;
        $companyInfo->address = $request->address;
        $companyInfo->office_start_time = $request->office_start_time;
        $companyInfo->office_end_time = $request->office_end_time;
        $companyInfo->break_start_time = $request->break_start_time;
        $companyInfo->break_end_time = $request->break_end_time;
        $companyInfo->update();

        return redirect()->route('company-info.show',  $companyInfo->id)->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Company Setting is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyInfo  $companyInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyInfo $companyInfo)
    {
        //
    }
}
