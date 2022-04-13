<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\HeadOfDep;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('department.index');
    }

    public function ssd(Request $request)
    {
        $departments = Department::query();
        return DataTables::of($departments)
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('department.edit', $each->id).'" class="btn btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn ms-2" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->addColumn('head_dep', function($each){
                return $each->head_department ? $each->head_department->title : '-';
            })
            ->filterColumn('head_dep', function($query, $keyword){
                $query->whereHas('head_department', function ($q) use ($keyword) {
                    $q->where('title', 'like', "%$keyword%");
                });
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
        $hods = HeadOfDep::orderBy('title')->get();
        return view('department.create', compact('hods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartmentRequest $request)
    {
       $department = new Department();
       $department->name = $request->name;
       $department->head_department_id = $request->head_of_dep;
       $department->phone = $request->phone;
       $department->email = $request->email;
       $department->start_date = Carbon::createFromFormat('d.m.Y', $request->start_date)->format('Y-m-d');;
       $department->total_employees = $request->total;
       $department->save();

       return redirect()->route('department.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $department->name . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $hods = HeadOfDep::orderBy('title')->get();
        return view('department.edit', compact('department', 'hods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDepartmentRequest  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->head_department_id = $request->head_of_dep;
        $department->phone = $request->phone;
        $department->email = $request->email;
        $department->start_date = Carbon::createFromFormat('d.m.Y', $request->start_date)->format('Y-m-d');;
        $department->total_employees = $request->total;
        $department->save();

        return redirect()->route('department.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $department->name . ' is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        return $department->delete();
    }
}
