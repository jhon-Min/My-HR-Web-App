@extends('layouts.app')

@section('title')
    Edit {{ $employee->name }}
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Employees</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Employee
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Employee</h5>
                        <a href="{{ route('employee.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('employee.update', $employee->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control" name="employee_id"
                                        value="{{ old('employee_id', $employee->employee_id) }}" placeholder="Employee ID"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $employee->email) }}" placeholder="Email" required />
                                </div>

                                <div class="mb-5">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control" name="nrc_number"
                                        value="{{ old('nrc_number', $employee->nrc_number) }}" placeholder="NRC"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control bd" name="birthday"
                                        value="{{ old('birthday', \Carbon\Carbon::createFromFormat('Y-m-d', $employee->birthday)->format('d.m.Y')) }}"
                                        placeholder="Birth Date">
                                </div>

                                <div class="">
                                    <select class="form-select single-select" name="department"
                                        data-placeholder="Choose Department">
                                        <option></option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if ($employee->dep_id == $department->id) selected @endif>{{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $employee->name) }}" placeholder="Your Name" required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" name="phone"
                                        value="{{ old('phone', $employee->phone) }}" placeholder="Phone" required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" name="pin_code"
                                        value="{{ old('pin_code', $employee->pin_code) }}" placeholder="Pin Code"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <select class="form-select" name="gender" data-placeholder="Choose one thing">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control doj" name="date_of_join"
                                        value="{{ old('date_of_join', \Carbon\Carbon::createFromFormat('Y-m-d', $employee->date_of_join)->format('d.m.Y')) }}"
                                        placeholder="Joining Date">
                                </div>

                                <div class="">
                                    <select class="form-select single-select" name="is_present"
                                        data-placeholder="Is Present?">
                                        <option></option>
                                        <option value="1" @if ($employee->is_present == 1) selected @endif>Yes</option>
                                        <option value="0" @if ($employee->is_present == 0) selected @endif>No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="">
                                <select class="form-select select-custom-multiple" name="roles[]"
                                    data-placeholder="Choose Role" multiple>
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if (in_array($role->id, $old_roles)) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <textarea class="form-control" rows="3" name="address"
                                    placeholder="Address">{{ old('address', $employee->address) }}</textarea>
                            </div>

                            <div class="text-center my-5">
                                <a href="{{ route('employee.index') }}" class="btn btn-danger ">Cancel</a>
                                <button class="btn btn-primary px-5 ms-2">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateEmployeeRequest', '#editForm') !!}
    <script>
        $(".bd").flatpickr({
            maxDate: "today",
            dateFormat: "d.m.Y",
        });

        $(".doj").flatpickr({
            dateFormat: "d.m.Y",
        });

        $('.select-custom-multiple').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: true,
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
