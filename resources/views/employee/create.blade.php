@extends('layouts.app')

@section('name')
    Add Employee
@endsection

@section('content')
    <div class="row">
        <div class="my-4 d-flex align-items-baseline">
            <div class="me-2">
                <span class="fs-4">Employees</span>
                <span class="fs-4 ms-1 text-muted">|</span>
            </div>
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Employees</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Add Employee
                    </li>
                </ol>
            </nav>
        </div>

        <div class="col-12">
            <div class="card emp-card shadow-sm">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold">Add Employee</h5>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="fa-solid fa-book me-1"></i>
                            <span>Lists</span>
                        </button>
                    </div>

                    <form action="">
                        <div class="row g-5">
                            <div class="col-12 col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control" placeholder="Employee ID" required />
                                </div>

                                <div class="mb-5">
                                    <input type="email" class="form-control" placeholder="Email" required />
                                </div>

                                <div class="mb-5">
                                    <input type="password" class="form-control" placeholder="Password" required />
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control" placeholder="NRC" required />
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control bd" placeholder="Birth Date">
                                </div>

                                <div class="">
                                    <select class="form-select single-select" data-placeholder="Choose one thing">
                                        <option></option>
                                        <option>Reactive</option>
                                        <option>Solution</option>
                                        <option>Conglomeration</option>
                                        <option>Algoritm</option>
                                        <option>Holistic</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control" placeholder="Your Name" required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" placeholder="Phone" required />
                                </div>

                                <div class="mb-5">
                                    <input type="number" class="form-control" placeholder="Pin Code" required />
                                </div>

                                <div class="mb-5">
                                    <select class="form-select" data-placeholder="Choose one thing">
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <input type="text" class="form-control doj" placeholder="Joining Date">
                                </div>

                                <div class="">
                                    <select class="form-select single-select" data-placeholder="Is Present?">
                                        <option></option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            <div class="">
                                <select class="form-select select-custom-multiple" data-placeholder="Choose Role" multiple>
                                    <option></option>
                                    <option>Reactive</option>
                                    <option>Solution</option>
                                    <option>Conglomeration</option>
                                    <option>Algoritm</option>
                                    <option>Holistic</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <textarea class="form-control" rows="3" placeholder="Address"></textarea>
                            </div>

                            <div class="text-center my-5">
                                <a class="btn btn-danger ">Cancel</a>
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
