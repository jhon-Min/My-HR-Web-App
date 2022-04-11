<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
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
