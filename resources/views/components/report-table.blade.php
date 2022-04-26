<div class="table-responsive mt-4">
    <table class="table table-bordered table-hover">
        <thead>
            <th>Employee</th>
            @foreach ($periods as $period)
                <th @if ($period->format('D') == 'Sat' or $period->format('D') == 'Sun') class="text-danger bg-light font-weight-bold" @endif>
                    <span>{{ $period->format('d') }}</span>
                    <span class="small">{{ $period->format('D') }}</span>
                </th>
            @endforeach
        </thead>

        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        <span class="small text-secondary">{{ $employee->employee_id }}</span>
                        <br>
                        <a href="{{ route('employee.show', $employee->id) }}"
                            class="text-dark">{{ $employee->name }}</a>
                    </td>
                    @foreach ($periods as $period)
                        @php
                            $checkin_icon = '';
                            $checkout_icon = '';
                            $office_start_time = $period->format('Y-m-d') . ' ' . $company->office_start_time;
                            $office_end_time = $period->format('Y-m-d') . ' ' . $company->office_end_time;
                            $break_start_time = $period->format('Y-m-d') . ' ' . $company->break_start_time;
                            $break_end_time = $period->format('Y-m-d') . ' ' . $company->break_end_time;

                            $attendance = collect($attendances)
                                ->where('user_id', $employee->id)
                                ->where('date', $period->format('Y-m-d'))
                                ->first();

                            if ($attendance) {
                                if (!is_null($attendance->check_in)) {
                                    if ($attendance->check_in <= $office_start_time) {
                                        $checkin_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                    } elseif ($attendance->check_in > $office_start_time and $attendance->check_in < $break_start_time) {
                                        $checkin_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                    } else {
                                        $checkin_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                    }
                                } else {
                                    $checkin_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                }

                                if (!is_null($attendance->check_out)) {
                                    if ($attendance->check_out < $break_end_time) {
                                        $checkout_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                    } elseif ($attendance->check_out < $office_end_time and $attendance->check_out > $break_end_time) {
                                        $checkout_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                    } else {
                                        $checkout_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                    }
                                } else {
                                    $checkout_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                }
                            }
                        @endphp

                        <td @if ($period->format('D') == 'Sat' or $period->format('D') == 'Sun') class="bg-light" @endif>
                            <div class="text-center">{!! $checkin_icon !!}</div>
                            <div class="text-center">{!! $checkout_icon !!}</div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
