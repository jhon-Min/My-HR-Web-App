@extends('layouts.app')

@section('title')
    Edit Attendance
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Attendance Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Attendance
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach

            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Attendance</h5>
                        <a href="{{ route('attendance.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>


                    <form action="{{ route('attendance.update', $attendance->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="mb-4" style="margin-top: 20px">
                                    <select class="form-select single-select" name="user_id" id="floatingSelect"
                                        data-placeholder="Choose Employee">
                                        <option></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if ($employee->id == old('employee_id', $attendance->user_id)) selected @endif>{{ $employee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- <label for="floatingSelect">Choose Employee</label> -->
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" name="check_in" id="floatingInput"
                                        value="{{ old('check_in', Carbon\Carbon::parse($attendance->check_in)->format('H:i:s')) }}">
                                    <label for="floatingInput">Check In</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control dt" name="date"
                                        value="{{ old('date', Carbon\Carbon::parse($attendance->date)->format('d.m.Y')) }}"
                                        id="floatingInput">
                                    <label for="floatingInput">Date</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" id="floatingInput" name="check_out"
                                        value="{{ old('check_out', Carbon\Carbon::parse($attendance->check_out)->format('H:i:s')) }}">
                                    <label for="floatingInput">Check Out</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4 mb-3">
                            <a href="{{ route('attendance.index') }}" class="btn btn-danger">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateAttendanceRequest', '#editForm') !!}
    <script>
        $(".dt").flatpickr({
            dateFormat: "d.m.Y",
        });

        $(".time-picker")
            .daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                autoApply: true,
                locale: {
                    format: "HH:mm:ss",
                },
            })
            .on("show.daterangepicker", function(ev, picker) {
                picker.container.find(".calendar-table").hide();
            });

        $(".single-select").select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data("placeholder"),
            dropdownCssClass: "select2--small",
            //   allowClear: true,
        });
    </script>
@endsection
