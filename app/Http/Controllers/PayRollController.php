<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Carbon\CarbonPeriod;
use App\Models\CheckInOut;
use App\Models\CompanyInfo;
use Illuminate\Http\Request;

class PayRollController extends Controller
{
    public function index()
    {
        $this->checking('view_payroll');
        return view('payroll.index');
    }

    public function payrollTable(Request $request)
    {
        $this->checking('view_payroll');
        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        // $dayInMonth = Carbon::parse($start)->daysInMonth;
        $dayInMonth = Carbon::now()->month($month)->daysInMonth;

        $workingDays = Carbon::parse($start)->subDays(1)->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        }, Carbon::parse($end));

        $offDays = $dayInMonth - $workingDays;

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('name', 'like', '%' . $request->employee_name . '%')->get();
        $company = CompanyInfo::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('payroll.table', compact('periods', 'employees', 'company', 'attendances', 'dayInMonth', 'workingDays', 'offDays', 'month', 'year'));
    }
}
