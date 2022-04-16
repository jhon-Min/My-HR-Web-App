<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CheckInOut;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    public function ssd(Request $request)
    {
        $this->checking('view_attendance');
        $attendances = CheckInOut::with('employee');
        return DataTables::of($attendances)
            ->filterColumn('employee', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('date', function ($each) {
                return Carbon::parse($each->date)->format('d.m.Y');
            })
            ->editColumn('check_in', function ($each) {
                return Carbon::parse($each->check_in)->format('H:i:s a');
            })
            ->editColumn('check_out', function ($each) {
                return Carbon::parse($each->check_out)->format('H:i:s a');
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '';
                $del = '';

                if (auth()->user()->can('edit_attendance')) {
                    $edit = '<a href="'.route('attendance.edit', $each->id).'" class="btn me-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
                }

                if (auth()->user()->can('delete_attendance')) {
                    $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';
                }

                return '<div class="action-icon">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $this->checking('view_attendance');
        return view('attendance.index');
    }

    public function create()
    {
        $this->checking('create_attendance');
        return view('attendance.create');
    }

    public function store(StoreAttendanceRequest $request)
    {
        if (CheckInOut::where('user_id', $request->user_id)->where('date', $request->date)->exists()) {
            // return back()->with('toast', ['icon' => 'error', 'title' => 'Already Defined.']);
            return back()->withErrors(['fail' => 'Already defined.'])->withInput();
        }

        $currentDate = Carbon::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');
        $attendance = new CheckInOut();
        $attendance->user_id = $request->user_id;
        $attendance->date = $currentDate;
        $attendance->check_in = $currentDate . ' ' . $request->check_in;
        $attendance->check_out = $currentDate . ' ' . $request->check_out;
        $attendance->save();

        return redirect()->route('attendance.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'New attendance is successfully created']);
    }

    public function edit(CheckInOut $attendance)
    {
        $this->checking('edit_attendance');
        return view('attendance.edit', compact('attendance'));
    }

    public function update(UpdateAttendanceRequest $request, CheckInOut $attendance)
    {
        $currentDate = Carbon::createFromFormat('d.m.Y', $request->date)->format('Y-m-d');
        $attendance->user_id = $request->user_id;
        $attendance->date = $currentDate;
        $attendance->check_in = $currentDate . ' ' . $request->check_in;
        $attendance->check_out = $currentDate . ' ' . $request->check_out;
        $attendance->update();

        return redirect()->route('attendance.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'New attendance is successfully updated']);
    }

    public function destroy(CheckInOut $attendance)
    {
        $this->checking('delete_attendance');
        return $attendance->delete();
    }
}
