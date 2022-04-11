<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHeadOfDepRequest;
use App\Http\Requests\UpdateHeadOfDepRequest;
use App\Models\HeadOfDep;

class HeadOfDepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('head-department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('head-department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHeadOfDepRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHeadOfDepRequest $request)
    {
        $head_dep = new HeadOfDep();
        $head_dep->title = $request->title;
        $head_dep->save();

        return redirect()->route('head-of-department.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $head_dep->title . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function show(HeadOfDep $headOfDep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function edit(HeadOfDep $headOfDep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHeadOfDepRequest  $request
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHeadOfDepRequest $request, HeadOfDep $headOfDep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeadOfDep $headOfDep)
    {
        //
    }
}
