@extends('layouts.app')

@section('title')
    Add Salary Record
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Add Salary</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Salary Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Add Salary</h5>
                        <a href="{{ route('salary.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('salary.store') }}" id="createForm" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-4">
                                    <label class="text-secondary small">Employee</label>
                                    <select name="user_id" data-placeholder="Select Employee"
                                        class="form-control single-select">
                                        <option value=""></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if (old('user_id') == $employee->id) selected @endif>
                                                {{ $employee->employee_id }}
                                                ({{ $employee->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="text-secondary small">Year</label>
                                    <select name="year" data-placeholder="Select Year" class="form-control single-select">
                                        <option value=""></option>
                                        @for ($i = 0; $i <= 3; $i++)
                                            <option value="{{ now()->addYears(3)->subYears($i)->format('Y') }}">
                                                {{ now()->addYears(3)->subYears($i)->format('Y') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-4">
                                    <label class="text-secondary small">Month</label>
                                    <select name="month" class="form-control single-select" data-placeholder="Select Month">
                                        <option value=""></option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Aug</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                </div>

                                <div class="" style="padding-top: 3px">
                                    <label class="text-secondary small">Amount (MMK)</label>
                                    <input type="number" id="emp" class="form-control" value="{{ old('amount') }}"
                                        name="amount" placeholder="1000">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5 mb-3">
                            <a href="{{ route('salary.index') }}" class="btn btn-danger ">Cancel</a>
                            <button class="btn btn-primary px-5 ms-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\StoreSalaryRequest', '#createForm') !!}
    <script>
        $(".single-select").select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data("placeholder"),
            dropdownCssClass: "select2--small",
            //   allowClear: true,
        });
    </script>
@endsection
