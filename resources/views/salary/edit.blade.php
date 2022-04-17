@extends('layouts.app')

@section('title')
    Edit Salary Record
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Edit Salary</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Salary Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Edit Salary</h5>
                        <a href="{{ route('salary.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </a>
                    </div>

                    <form action="{{ route('salary.update', $salary->id) }}" id="createForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-4">
                                    <label class="text-secondary small">Employee</label>
                                    <select name="user_id" data-placeholder="Select Employee"
                                        class="form-control single-select">
                                        <option value=""></option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if (old('user_id', $salary->user_id) == $employee->id) selected @endif>
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
                                            <option value="{{ now()->addYears(3)->subYears($i)->format('Y') }}"
                                                @if ($salary->year ==
    now()->addYears(3)->subYears($i)->format('Y')) selected @endif>
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
                                        <option value="">-- Please Choose (Month) --</option>
                                        <option value="01" @if ($salary->month == '01') selected @endif>Jan</option>
                                        <option value="02" @if ($salary->month == '02') selected @endif>Feb</option>
                                        <option value="03" @if ($salary->month == '03') selected @endif>Mar</option>
                                        <option value="04" @if ($salary->month == '04') selected @endif>Apr</option>
                                        <option value="05" @if ($salary->month == '05') selected @endif>May</option>
                                        <option value="06" @if ($salary->month == '06') selected @endif>Jun</option>
                                        <option value="07" @if ($salary->month == '07') selected @endif>Jul</option>
                                        <option value="08" @if ($salary->month == '08') selected @endif>Aug</option>
                                        <option value="09" @if ($salary->month == '09') selected @endif>Sep</option>
                                        <option value="10" @if ($salary->month == '10') selected @endif>Oct</option>
                                        <option value="11" @if ($salary->month == '11') selected @endif>Nov</option>
                                        <option value="12" @if ($salary->month == '12') selected @endif>Dec</option>
                                    </select>
                                </div>

                                <div class="" style="padding-top: 3px">
                                    <label class="text-secondary small">Amount (MMK)</label>
                                    <input type="number" id="emp" class="form-control"
                                        value="{{ old('amount', $salary->amount) }}" name="amount" placeholder="1000">
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
