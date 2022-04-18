<div class="table-responsive mt-4">
    <table class="table table-hover table-striped table-payroll">
        <thead>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Role</th>
            <th class="text-center">Days of Month</th>
            <th class="text-center">Working Days</th>
            <th class="text-center">Off Day</th>
            <th class="text-center">Attendance Day</th>
            <th class="text-center">Leave</th>
            <th class="text-center">PerDay</th>
            <th class="text-center">Total</th>
        </thead>

        <tbody>
            @foreach ($employees as $employee)
                @php
                    $attendanceDay = 0;
                    $salary = collect($employee->salaries)
                        ->where('month', $month)
                        ->where('year', $year)
                        ->first();
                    $perday = $salary ? $salary->amount / $workingDays : 0;
                @endphp

                @foreach ($periods as $period)
                    @php
                        $office_start_time = $period->format('Y-m-d') . ' ' . $company->office_start_time;
                        $office_end_time = $period->format('Y-m-d') . ' ' . $company->office_end_time;
                        $break_start_time = $period->format('Y-m-d') . ' ' . $company->break_start_time;
                        $break_end_time = $period->format('Y-m-d') . ' ' . $company->break_end_time;

                        $attendance = collect($attendances)
                            ->where('user_id', $employee->id)
                            ->where('date', $period->format('Y-m-d'))
                            ->first();

                        if ($attendance) {
                            if ($attendance->check_in <= $office_start_time) {
                                $attendanceDay += 0.5;
                            } elseif ($attendance->check_in > $office_start_time and $attendance->check_in < $break_start_time) {
                                $attendanceDay += 0.5;
                            } else {
                                $attendanceDay += 0;
                            }

                            if ($attendance->check_out < $break_end_time) {
                                $attendanceDay += 0;
                            } elseif ($attendance->check_out < $office_end_time and $attendance->check_out > $break_end_time) {
                                $attendanceDay += 0.5;
                            } else {
                                $attendanceDay += 0.5;
                            }
                        }
                    @endphp
                @endforeach

                @php
                    $leaveDays = $workingDays - $attendanceDay;
                    $total = $attendanceDay * $perday;
                @endphp

                <tr>
                    <td class="text-center">{{ $employee->employee_id }}</td>
                    <td class="text-center">
                        <a href="{{ route('employee.show', $employee->id) }}">
                            {{ $employee->name }}
                        </a>
                    </td>
                    <td class="text-center">{{ implode(', ', $employee->roles->pluck('name')->toArray()) }}</td>
                    <td class="text-center">{{ $dayInMonth }}</td>
                    <td class="text-center">{{ $workingDays }}</td>
                    <td class="text-center">{{ $offDays }}</td>
                    <td class="text-center">{{ $attendanceDay }}</td>
                    <td class="text-center">{{ $leaveDays }}</td>
                    <td class="text-center">{{ number_format($perday) }}</td>
                    <td class="text-center">{{ number_format($total) }} Ks</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
