<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function ssd(Request $request)
    {
        $employees = User::query();
        return DataTables::of($employees)->
            editColumn('is_present', function ($each) {
                if ($each->is_present == 1) {
                    return ' <span class="badge badge-pill badge-success p-2">Present</span>';
                } else {
                    return ' <span class="badge badge-pill badge-danger p-2">Leave</span>';
                }
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('role_name', function ($each) {
                $output = "";
                foreach ($each->roles as $role) {
                    $output .= "<span class='badge badge-pill badge-primary m-1 p-2'>$role->name</span>";
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="' . route('employee.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';

                $detail = '<a href="' . route('employee.show', $each->id) . '" class="btn btn-sm btn-secondary p-2 rounded mr-2"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';

                return '<div class="action-icon">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['is_present', 'action', 'role_name'])
            ->make(true);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(StoreEmployee $request)
    {
        $employee = new User();
        $employee->employee_id = $request->employee_id;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->pin_code  = $request->pin_code;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->dep_id = $request->department;
        $employee->birthday = Carbon::createFromFormat('d.m.Y',$request->birthday)->format('Y-m-d');
        $employee->address = $request->address;
        $employee->date_of_join = Carbon::createFromFormat('d.m.Y',$request->date_of_join)->format('Y-m-d');
        $employee->is_present = $request->is_present;
        $employee->save();

        return redirect()->route('employee.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Employee is successfully created']);
    }
}
