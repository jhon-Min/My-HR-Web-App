<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\CheckInOut;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\CompanyInfo;

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
                return Carbon::parse($each->check_in)->format('h:i:s a');
            })
            ->editColumn('check_out', function ($each) {
                return Carbon::parse($each->check_out)->format('h:i:s a');
            })
            ->addColumn('profile', function ($each) {
                return '<img src="' . $each->employee->profile_img_path() . '" alt="" class="profile-thumbnail border border-1 border-white shadow-sm rounded-circle" />';
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->addColumn('employee_id', function ($each) {
                return $each->employee ? $each->employee->employee_id : '-';
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
            ->rawColumns(['action', 'profile'])
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
        $employees = User::orderBy('name')->get();
        return view('attendance.create', compact('employees'));
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
        $employees = User::orderBy('name')->get();
        return view('attendance.edit', compact('attendance', 'employees'));
    }

    public function update(UpdateAttendanceRequest $request, CheckInOut $attendance)
    {
        $this->checking('edit_attendance');
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

    public function report(Request $request)
    {
        return view('attendance.report');
    }

    public function reportTable(Request $request)
    {
        if (!auth()->user()->can('view_attendance')) {
            abort(403, 'Unauthorized action');
        }

        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('employee_id', 'like', '%' . $request->employee_name . '%')->get();
        $company = CompanyInfo::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('components.report-table', compact('periods', 'employees', 'company', 'attendances'));
    }
}
