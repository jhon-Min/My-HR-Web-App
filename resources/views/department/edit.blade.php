@extends('layouts.app')

@section('title')
    Edit {{ $department->name }}
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit Department</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('department.index') }}">Departments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Department
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Add Department</h5>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </button>
                    </div>

                    <form action="{{ route('department.update', $department->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $department->name) }}" placeholder="Department Name"
                                        required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" name="phone"
                                        value="{{ old('phone', $department->phone) }}" placeholder="Phone" required />
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control st-date" name="start_date"
                                        value="{{ old('start_date', $department->start_date) }}" placeholder="Start Date"
                                        required />
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-5 mt-m-2">
                                    <select class="form-select single-select" name="head_of_dep"
                                        data-placeholder="Choose Department">
                                        <option></option>
                                        @foreach ($hods as $hod)
                                            <option value="{{ $hod->id }}"
                                                @if ($hod->id == old('head_of_dep', $department->head_department_id)) selected @endif>{{ $hod->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $department->email) }}" placeholder="Email" required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" name="total"
                                        value="{{ old('total', $department->total_employees) }}"
                                        placeholder="Total Employees" required />
                                </div>
                            </div>

                            <div class="text-center mt-4 mb-3">
                                <a href="{{ route('department.index') }}" class="btn btn-danger ">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDepartmentRequest', '#editForm') !!}
    <script>
        $(".st-date").flatpickr({
            dateFormat: "d.m.Y",
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
