@extends('layouts.app')

@section('name')
    Edit Company Info
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Company Info</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">
                        Edit Company Information
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="fw-bold">Edit Info</h5>
                    </div>

                    <form action="{{ route('company-info.update', $companyInfo->id) }}" id="editForm" method="POST">
                        @csrf
                        @method('put')
                        <div class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="name"
                                        value="{{ old('name', $companyInfo->name) }}" id="floatingInput" placeholder="">
                                    <label for="floatingInput">Company Name</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control" name="phone"
                                        value="{{ old('phone', $companyInfo->phone) }}" id="floatingInput" placeholder="">
                                    <label for="floatingInput">Company Phone</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" id="floatingInput"
                                        name="office_start_time"
                                        value="{{ old('office_start_time', $companyInfo->office_start_time) }}">
                                    <label for="floatingInput">Office Start Time</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" name="break_start_time"
                                        value="{{ old('break_start_time', $companyInfo->break_start_time) }}"
                                        id="floatingInput" required />
                                    <label for="floatingInput">Break Start Time</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">

                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ old('email', $companyInfo->email) }}" id="floatingInput"
                                        placeholder="name@example.com">
                                    <label for="floatingInput">Email</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ old('address', $companyInfo->address) }}" id="floatingInput"
                                        placeholder="Address">
                                    <label for="floatingInput">Address</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" name="office_end_time"
                                        value="{{ old('office_end_time', $companyInfo->office_end_time) }}"
                                        placeholder="Office End Time" id="floatingInput" required />
                                    <label for="floatingInput">Office End Time</label>
                                </div>

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control time-picker" name="break_end_time"
                                        value="{{ old('break_end_time', $companyInfo->break_end_time) }}"
                                        id="floatingInput" required />
                                    <label for="floatingInput">Break End Time</label>
                                </div>
                            </div>

                            <div class="text-center mt-4 mb-3">
                                <a href="{{ route('company-info.show', $companyInfo->id) }}"
                                    class="btn btn-danger ">Cancel</a>
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCompanyInfoRequest', '#editForm') !!}
    <script>
        $(".time-picker").daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "timePickerSeconds": true,
            "autoApply": true,
            "locale": {
                "format": "HH:mm:ss",
            }
        }).on('show.daterangepicker', function(ev, picker) {
            picker.container.find('.calendar-table').hide();
        });;
    </script>
@endsection
