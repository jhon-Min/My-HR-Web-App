<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function ssd(Request $request)
    {
        $employees = User::query();
        return DataTables::of($employees)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('is_present', function($each){
                if ($each->is_present == 1) {
                    return ' <span class="badge rounded-pill bg-success">Yes</span>';
                } else {
                    return ' <span class="badge rounded-pill bg-danger">No</span>';
                }
            })
            ->addColumn('dept', function($each){
                return $each->department ? $each->department->name : '-';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                $edit = '<a href="'.route('employee.edit', $each->id).'" class="btn me-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('employee.show', $each->id) . '" class="btn btn-secondary btn-sm rounded-circle me-1"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit . $detail . $del . '</div>';
            })
            ->filterColumn('dept', function($query, $keyword){
                $query->whereHas('department', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->rawColumns(['action', 'is_present'])
            ->make(true);
    }

    public function create()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('employee.create', compact('roles'));
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
        $employee->syncRoles($request->roles);
        $employee->save();

        return redirect()->route('employee.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Employee is successfully created']);
    }

    public function edit(User $employee)
    {
        $old_roles = $employee->roles ? $employee->roles->pluck('id')->toArray() : [];
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('employee.edit', compact('employee','roles', 'old_roles'));
    }

    public function update(UpdateEmployeeRequest $request,User $employee)
    {
        $employee->employee_id = $request->employee_id;
        $employee->email = $request->email;
        $employee->password =  $request->password ? Hash::make($request->password) : $employee->password;
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
        $employee->syncRoles($request->roles);
        $employee->update();

        return redirect()->route('employee.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Employee is successfully updated']);
    }

    public function destroy(User $employee)
    {
        return $employee->delete();
    }
}
