<?php

namespace App\Http\Controllers;

use App\Models\HeadOfDep;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreHeadOfDepRequest;
use App\Http\Requests\UpdateHeadOfDepRequest;

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

    public function ssd(Request $request)
    {
        $head_deps = HeadOfDep::query();
        return Datatables::of($head_deps)
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                if (auth()->user()->can('edit_head-dept')) {
                    $edit = '<a href="'.route('head-of-department.edit', $each->id).'" class="btn btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                }

                if (auth()->user()->can('delete_head-dept')) {
                    $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn ms-2" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';
                }

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checking('create_head-dept');
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
        $this->checking('create_head-dept');
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
    public function edit($id)
    {
        $this->checking('edit_head-dept');
        $hod = HeadOfDep::findOrFail($id);
        return view('head-department.edit', compact('hod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHeadOfDepRequest  $request
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHeadOfDepRequest $request, $id)
    {
        $this->checking('edit_head-dept');
        $hod = HeadOfDep::findOrFail($id);
        $hod->title = $request->title;
        $hod->update();

        return redirect()->route('head-of-department.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $hod->title . ' is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeadOfDep  $headOfDep
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checking('delete_head-dept');
        $hod = HeadOfDep::findOrFail($id);
        $hod->delete();
    }
}
