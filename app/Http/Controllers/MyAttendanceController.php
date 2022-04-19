<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\CheckInOut;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MyAttendanceController extends Controller
{
    public function scanQr(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('my-attendance.scan-qr', compact('user'));
    }

    public function storeQr(Request $request)
    {
        if (now()->format('D') == 'Sat' or now()->format('D') == 'Sun') {
            return [
                "status" => "error",
                "title" => "Today is company off-day."
            ];
        }

        if (!Hash::check(date('Y-m-d'), $request->hash_value)) {
            return [
                "status" => "error",
                "title" => "QR code is invalid"
            ];
        } else {
            $user = auth()->user();

            $check = CheckInOut::firstOrCreate([
                'user_id' => $user->id,
                'date' => now()->format('Y-m-d')
            ]);

            if (!is_null($check->check_in) && !is_null($check->check_out)) {
                return [
                    "status" => "info",
                    "title" => "Already check-in and check-out today."
                ];
            }

            if (is_null($check->check_in)) {
                $check->check_in = now();
                $title =  "Successfully Check In";
                $message = $user->name . ' သည် ' . now() . ' တွင် check-in ကိုပြုလုပ်ပါသည်။';
            } else {
                if (is_null($check->check_out)) {
                    $check->check_out = now();
                    $title = "Successfully Check Out";
                    $message = $user->name . ' သည် ' . now() . ' တွင် check-out ကိုပြုလုပ်ပါသည်။';
                }
            }

            $check->update();

            return [
                "status" => "success",
                "title" => $title,
                "message" => $message
            ];
        }
    }

    public function ssd(Request $request)
    {
        $attendance = CheckInOut::with('employee')->where('user_id', auth()->user()->id);

        if ($request->month) {
            $attendance = $attendance->whereMonth('date', $request->month);
        }

        if ($request->year) {
            $attendance = $attendance->whereYear('date', $request->year);
        }
        return DataTables::of($attendance)
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
               if( Carbon::parse($each->check_in)->format('H:i:s') <= '09:00:00'){
                 return '<span class="text-success">'.Carbon::parse($each->check_in)->format('h:i:s a').'<span>';
               }else{
                 return '<span class="text-danger">'.Carbon::parse($each->check_in)->format('h:i:s a').'<span>';
               }
            })
            ->editColumn('check_out', function ($each) {
                return Carbon::parse($each->check_out)->format('h:i:s a');
            })
            ->addColumn('profile', function ($each) {
                return '<div class="header_img"><img src="' . $each->employee->profile_img_path() . '" alt="" class="border border-1 border-white shadow-sm" /></div>';
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
            ->rawColumns(['profile', 'check_in'])
            ->make(true);
    }

    public function myReportTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('id', auth()->user()->id)->get();
        $company = CompanyInfo::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('components.report-table', compact('periods', 'employees', 'company', 'attendances'));
    }

}
