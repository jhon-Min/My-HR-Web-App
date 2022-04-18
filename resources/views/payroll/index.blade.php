@extends('layouts.app')

@section('title')
    Payroll
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Payroll</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Payroll Lists
                    </li>
                </x-bread-crumb>
            </nav>
        </div>


        <div class="col-12">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <input type="text" class="form-control" id="employee-name" placeholder="Employee Name">
                        </div>

                        <div class="col-3">
                            <div class="form-group mb-3">
                                <select class="form-control" name="" id="select-month">
                                    <option value="">---- Choose Month ----</option>
                                    <option value="01" @if (now()->format('m') == '01') selected @endif>Jan</option>
                                    <option value="02" @if (now()->format('m') == '02') selected @endif>Feb</option>
                                    <option value="03" @if (now()->format('m') == '03') selected @endif>Mar</option>
                                    <option value="04" @if (now()->format('m') == '04') selected @endif>Apr</option>
                                    <option value="05" @if (now()->format('m') == '05') selected @endif>May</option>
                                    <option value="06" @if (now()->format('m') == '06') selected @endif>Jun</option>
                                    <option value="07" @if (now()->format('m') == '07') selected @endif>Jul</option>
                                    <option value="08" @if (now()->format('m') == '08') selected @endif>Aug</option>
                                    <option value="09" @if (now()->format('m') == '09') selected @endif>Sep</option>
                                    <option value="10" @if (now()->format('m') == '10') selected @endif>Oct</option>
                                    <option value="11" @if (now()->format('m') == '11') selected @endif>Nov</option>
                                    <option value="12" @if (now()->format('m') == '12') selected @endif>Dec</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-3">
                            <div class="form-group">
                                <select name="" class="form-control" id="select-year">
                                    <option value="">-- Please Choose (Year) --</option>
                                    @for ($i = 0; $i < 5; $i++)
                                        <option value="{{ now()->subYears($i)->format('Y') }}"
                                            @if (now()->format('Y') ==
    now()->subYears($i)->format('Y')) selected @endif>
                                            {{ now()->subYears($i)->format('Y') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <button class="btn btn-primary w-100 search-btn">Search</button>
                        </div>
                    </div>

                    <div class="payroll-table"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function payrollTable() {
            var month = $('#select-month').val();
            var year = $('#select-year').val();
            var employee_name = $('#employee-name').val();

            $.ajax({
                url: `/payroll/table?employee_name=${employee_name}&month=${month}&year=${year}`,
                type: 'GET',
                success: function(res) {
                    $('.payroll-table').html(res);
                }
            })
        }

        $('.search-btn').on('click', function(e) {
            e.preventDefault();
            payrollTable();
        })

        payrollTable();
    </script>
@endsection
