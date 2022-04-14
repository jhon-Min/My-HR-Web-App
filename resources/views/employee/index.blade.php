@extends('layouts.app')

@section('title')
    Employee Lists
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
                    <li class="breadcrumb-item active" aria-current="page">
                        All Employees
                    </li>
                </x-bread-crumb>
            </nav>
        </div>

        <div class="mb-3">
            <a href="{{ route('employee.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-circle-plus me-1"></i>
                Add
            </a>
        </div>

        <div class="col-12">
            <div class="card shadow-sm dt-card">
                <div class="card-body">
                    <table class="table table-hover table-striped w-100" id="dataTable">
                        <thead>
                            <th class="no-sort"></th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Is Present</th>
                            <th class="no-sort">Control</th>
                            <th class="text-center hidden no-sort">Updated_at</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('employee.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'dept',
                        name: 'dept',
                    },
                    {
                        data: 'is_present',
                        name: 'is_present',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                ],
                order: [
                    [4, "desc"]
                ],
            });

            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();

                var id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/employee/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
